<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Mail\welcomeEmail;
use App\Events\NewUser;
use GuzzleHttp\Client;
use App\Models\verifyToken;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use App\Mail\supportEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {


            return response()->json([
                "content" => 'Successful',
                "message" => 'Login Successful',
                "redirect" => url("dashboard")
            ]);
        } else {
            return response()->json([
                "content" => 'Error',
                "message" => "Invalid credentials",
                "redirect" => url("login")
            ]);
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'password' => 'string|required|confirmed|min:3',


        ]);


        $data = $request->all();
        $check = $this->create($data);


        $email = $request['email'];

        //$user_data['email'] = $request['email'];


        $validToken = rand(7650, 1234);
        $get_token = new verifyToken();
        $get_token->token = $validToken;
        $get_token->email = $email;
        $get_token->save();



        Mail::to($email)->send(new VerificationEmail($validToken));
        $userData = User::where('email', $request->email)->first();

        return redirect("verify/" . $userData->id);
    }

    public function resendCode($id)
    {

        $userData = User::where('id', $id)->first();
        $email = $userData->email;

        $validToken = rand(7650, 1234);
        $get_token = Auth::user();
        $get_token->token = $validToken;
        $get_token->update();



        Mail::to($email)->send(new VerificationEmail($validToken));


        return redirect("verify/" . $userData->id)->with('message', 'verification code has been resent to your email');
    }

    public function create(array $data)
    {
        $accountNumber = rand(1645566556, 5575755768);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->user_type == '1') {
                $result = DB::table('users')->where('user_type', '0')->get();
                return view('admin.home', compact('result'));
            } else {


                if (Auth::user()->is_activated == '1') {
                    $client = new Client();
                    $response = $client->get('https://api.coingecko.com/api/v3/simple/price', [
                        'query' => [
                            'ids' => 'ethereum',
                            'vs_currencies' => 'usd',
                        ],
                    ]);
                    // Decode the JSON response
                    $data = json_decode($response->getBody(), true);
                    $price = $data['ethereum']['usd'];




                    $data['deposit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Deposit')->where('status', '1')->sum('transaction_amount');

                    // deposit conversion
                    $data['deposit_eth'] = $data['deposit'] / $price;

                    $data['withdrawal'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Withdrawal')->where('status', '1')->sum('transaction_amount');

                    // deposit conversion
                    $data['withdrawal_eth'] = $data['withdrawal'] / $price;


                    $data['add_profit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'Profit')->where('status', '1')->sum('transaction_amount');
                    $data['debit_profit'] = Transaction::where('user_id', Auth::user()->id)->where('transaction_type', 'DebitProfit')->where('status', '1')->sum('transaction_amount');
                    $data['profit'] = $data['add_profit'] - $data['debit_profit'];
                    // deposit conversion
                    $data['profit_eth'] = $data['profit'] / $price;


                    $data['balance'] = $data['deposit'] + $data['profit'] -  $data['withdrawal'];
                    $data['balance_eth'] = $data['balance'] / $price;
                    return view('dashboard.home', $data);
                } else {

                    return redirect("verify/" . Auth::user()->id);
                }
            }
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function adminHome()
    {

        return view('admin.home');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        $response = ['content' => 'Logout Successful'];


        return response()->json($response);
    }

    public function logOut()
    {
        Session::flush();
        Auth::logout();

        return redirect("login")->with('Message', 'Your account has been verified Successfully.');
    }

    public function verify($id)
    {
        $user = User::where('id', $id)->first();
        $data['email'] = $user->email;
        $data['hash'] = $user->password;
        $data['id'] = $user->id;

        return view('auth.verify', $data);
    }


    public function emailVerify(Request $request)
    {
        $first_token = $request->input('digit');
        $second_token = $request->input('digit2');
        $third_token = $request->input('digit3');
        $fourth_token = $request->input('digit4');
        $get_token =  $first_token;
        $verify_token = User::where('token', $get_token)->first();
        if ($verify_token) {
            $user = User::where('email', $verify_token->email)->first();
            $user->is_activated = 1;
            $user->save();
            $user_email =  $user->email;
            $user_password =  $user->password;


            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'password' => '*********',

            ];


            Mail::to($user_email)->send(new welcomeEmail($data));

            return redirect("dashboard")->with('status', 'Your account has been verified Successfully, you can now login');
        } else {
            return back()->with('error', 'Incorrect Activation Code!');
        }
    }

    public function supportEmail(Request $request)

    {

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];




        Mail::to('support@vanamanllc.com ')->send(new supportEmail($data));

        return back()->with('status', 'Email Successfully sent');
    }
}
