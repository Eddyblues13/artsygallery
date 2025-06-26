<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\VerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // Check honeypot field
        if (!empty($data['honeypot'])) {
            abort(403, 'Bot detected!');
        }

        // Check timestamp (submission must take at least 3 seconds)
        if (isset($data['timestamp']) && (now()->timestamp - $data['timestamp']) < 3) {
            abort(403, 'Submission too fast!');
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $validToken = rand(7650, 1234);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'token' => $validToken,
            'address' => $data['address'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'password' => Hash::make($data['password']),
        ]);

        $email = $data['email'];
        Mail::to($email)->send(new VerificationEmail($validToken));
        return $user;
    }
}
