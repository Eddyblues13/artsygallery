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

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // If user is not activated, redirect to verify page
            $user = Auth::user();
            if ($user->is_activated != '1') {
                $redirectUrl = url("verify/" . $user->id);
                if ($request->expectsJson()) {
                    return response()->json([
                        "content" => "Successful",
                        "message" => "Please verify your email first.",
                        "redirect" => $redirectUrl,
                    ]);
                }
                return redirect($redirectUrl);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    "content" => "Successful",
                    "message" => "Login Successful",
                    "redirect" => route("dashboard"),
                ]);
            }
            return redirect()->route('dashboard');
        }

        if ($request->expectsJson()) {
            return response()->json([
                "content" => "Error",
                "message" => "Invalid email or password",
                "redirect" => url("login"),
            ]);
        }
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('error', 'Invalid email or password');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'phone' => 'required|string|max:30',
            'country' => 'required|string|max:100',
            'date_of_birth' => 'nullable|date',
            'password' => 'required|string|confirmed|min:3',
        ]);

        // Combine name parts into a single name field
        $nameParts = array_filter([
            $request->input('first_name'),
            $request->input('middle_name'),
            $request->input('last_name'),
        ]);
        $request->merge(['name' => implode(' ', $nameParts)]);

        $user = $this->create($request->all());

        // Activate user immediately
        $user->is_activated = '1';
        $user->save();

        try {
            Mail::to($user->email)->send(new VerificationEmail(null));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Welcome email failed: ' . $e->getMessage());
        }

        // Auto-login and redirect to dashboard
        Auth::login($user);

        return redirect()->route('dashboard')->with('message', 'Account created successfully!');
    }

    public function resendCode($id)
    {
        $user = User::findOrFail($id);

        // ✅ 4-digit token
        $token = random_int(1000, 9999);

        // ✅ update the SAME user being verified
        $user->token = $token;
        $user->save();

        try {
            Mail::to($user->email)->send(new VerificationEmail($token));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Verification email resend failed: ' . $e->getMessage());
        }

        return redirect("verify/" . $user->id)
            ->with('message', 'Verification code has been resent to your email');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'city' => $data['city'] ?? null,
            'state' => $data['state'] ?? null,
            'zip_code' => $data['zip_code'] ?? null,
            'phone' => $data['phone'],
            'country' => $data['country'],
            'date_of_birth' => $data['date_of_birth'] ?? null,
            'password' => $data['password'],
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
            ->whereIn('status', ['0', '1'])
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
        $data['balance'] = max(0, $data['deposit'] + $data['profit'] - $data['withdrawal']);

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
        // Support both single field "digit" (full code) and split fields "digit"+"digit2"+"digit3"+"digit4"
        $code = trim($request->input('digit', ''));

        // If the code is only 1 character, try concatenating split fields
        if (strlen($code) <= 1) {
            $code = trim(
                ($request->input('digit') ?? '') .
                    ($request->input('digit2') ?? '') .
                    ($request->input('digit3') ?? '') .
                    ($request->input('digit4') ?? '')
            );
        }

        if (strlen($code) !== 4 || !ctype_digit($code)) {
            return back()->with('error', 'Please enter a valid 4-digit activation code.');
        }

        $user = User::where('token', $code)->first();

        if (!$user) {
            return back()->with('error', 'Incorrect Activation Code! Please try again.');
        }

        $user->is_activated = 1;
        $user->token = null;
        $user->save();

        // Send welcome email
        try {
            Mail::to($user->email)->send(new welcomeEmail([
                'name' => $user->name,
                'email' => $user->email,
                'password' => '********',
            ]));
        } catch (\Exception $e) {
            // Log but don't block verification if email fails
            \Illuminate\Support\Facades\Log::error('Welcome email failed: ' . $e->getMessage());
        }

        // Log the user in
        Auth::login($user);

        return redirect()->route("homepage")->with('status', 'Your account has been verified successfully!');
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
