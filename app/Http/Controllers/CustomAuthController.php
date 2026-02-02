<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\PopupMessage;
use App\Mail\welcomeEmail;
use App\Mail\VerificationEmail;
use App\Mail\SupportEmail;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                "content" => "Successful",
                "message" => "Login Successful",
                "redirect" => url("dashboard"),
            ]);
        }

        return response()->json([
            "content" => "Error",
            "message" => "Invalid credentials",
            "redirect" => url("login"),
        ], 401);
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'country' => 'required|string|max:100',
            'password' => 'required|string|confirmed|min:3',
        ]);

        $user = $this->create($request->all());

        // ✅ 4-digit token
        $token = random_int(1000, 9999);

        // ✅ store token on user (consistent with your emailVerify())
        $user->token = $token;
        $user->save();

        Mail::to($user->email)->send(new VerificationEmail($token));

        return redirect("verify/" . $user->id);
    }

    public function resendCode($id)
    {
        $user = User::findOrFail($id);

        // ✅ 4-digit token
        $token = random_int(1000, 9999);

        // ✅ update the SAME user being verified
        $user->token = $token;
        $user->save();

        Mail::to($user->email)->send(new VerificationEmail($token));

        return redirect("verify/" . $user->id)
            ->with('message', 'Verification code has been resent to your email');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect("login")->withSuccess('You are not allowed to access');
        }

        // Admin
        if (Auth::user()->user_type == '1') {
            return redirect()->route('admin.dashboard');
        }

        // User not activated
        if (Auth::user()->is_activated != '1') {
            return redirect("verify/" . Auth::user()->id);
        }



        $userId = Auth::id();

        $data = [];

        $data['deposit'] = Transaction::where('user_id', $userId)
            ->where('transaction_type', 'Deposit')
            ->where('status', '1')
            ->sum('transaction_amount');

        $data['withdrawal'] = Transaction::where('user_id', $userId)
            ->where('transaction_type', 'Withdrawal')
            ->where('status', '1')
            ->sum('transaction_amount');

        $data['add_profit'] = Transaction::where('user_id', $userId)
            ->where('transaction_type', 'Profit')
            ->where('status', '1')
            ->sum('transaction_amount');

        $data['debit_profit'] = Transaction::where('user_id', $userId)
            ->where('transaction_type', 'DebitProfit')
            ->where('status', '1')
            ->sum('transaction_amount');

        $data['profit'] = $data['add_profit'] - $data['debit_profit'];
        $data['balance'] = $data['deposit'] + $data['profit'] - $data['withdrawal'];

        // ✅ conversions only if price is valid
        $data['deposit_eth'] = 0;
        $data['withdrawal_eth'] = 0;
        $data['profit_eth'] = 0;
        $data['balance_eth'] = 0;

        // ✅ POPUPS
        $user = Auth::user();

        $general = PopupMessage::query()
            ->active()
            ->where('type', 'general')
            ->orderByDesc('created_at')
            ->get();

        $userSpecific = PopupMessage::query()
            ->active()
            ->where('type', 'user_specific')
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        $data['popups'] = $general->merge($userSpecific);

        return view('dashboard.home', $data);
    }

    public function adminHome()
    {
        return view('admin.home');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return response()->json(['content' => 'Logout Successful']);
    }

    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return redirect("login")->with('Message', 'Logged out successfully.');
    }

    public function verify($id)
    {
        $user = User::findOrFail($id);

        return view('auth.verify', [
            'email' => $user->email,
            'hash' => $user->password,
            'id' => $user->id,
        ]);
    }

    public function emailVerify(Request $request)
    {
        // ✅ combine 4 digits (you were using only digit1 before)
        $code = trim(
            ($request->input('digit') ?? '') .
            ($request->input('digit2') ?? '') .
            ($request->input('digit3') ?? '') .
            ($request->input('digit4') ?? '')
        );

        if (strlen($code) !== 4 || !ctype_digit($code)) {
            return back()->with('error', 'Invalid Activation Code format!');
        }

        $user = User::where('token', $code)->first();

        if (!$user) {
            return back()->with('error', 'Incorrect Activation Code!');
        }

        $user->is_activated = 1;
        $user->token = null; // ✅ invalidate token after use
        $user->save();

        Mail::to($user->email)->send(new welcomeEmail([
            'name' => $user->name,
            'email' => $user->email,
            'password' => '*********',
        ]));

        return redirect("dashboard")->with('status', 'Your account has been verified Successfully, you can now login');
    }

    public function supportEmail(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Mail::to('support@vanamanllc.com')->send(new SupportEmail([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]));

        return back()->with('status', 'Email Successfully sent');
    }
}
