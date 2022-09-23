<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use App\Models\UserVerify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SampleController extends Controller
{
    function index()
    {
        return view('login');
    }

    function registration()
    {
        return view('registration');
    }

    function validate_registration(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|min:9',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required'
        ]);
        $data = $request->all();
        $user = User::create([
            'username' => strip_tags($data['username']),
            'email' => $data['email'],
            'first_name' => strip_tags($data['first_name']),
            'last_name' => strip_tags($data['last_name']),
            'phone' => strip_tags($data['phone']),
            'password' => Hash::make($data['password']),
            'country_id' => $data['country'],
            'state_id' => $data['state'],
            'city_id' => $data['city']
        ]);

        if ($user)
        {
            $details = [
                'title' => 'Mail from LaravelSite.com',
                'body' => 'Hello, ' . $data['username'] . '! This is testing mail!'
            ];

            $token = Str::random(64);
            UserVerify::create([
                'user_id' => $user->id,
                'token' => $token
            ]);

            Mail::to($data['email'])->send(new MyTestMail($details));
            Mail::send('emails.emailVerificationEmail', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });
        }

        return redirect('login')->with('success', 'Registration completed. Verify your email and sign in!');
    }

    function validate_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) && Auth::user()->is_email_verified == 1)
        {
            if (Auth::user()->role_as == '1') {
                return redirect()->intended('dashboard')->with('success', 'Ypu logged in as an Admin');
            } else {
                return redirect()->intended('dashboard')->with('success', 'You logged successfully');
            }
        }

        return redirect('login')->with('success', 'Data are not valid or you did not verified your email');
    }

    function dashboard()
    {
        if (Auth::check())
        {
            return view('dashboard');
        }

        return redirect('login')->with('success', 'You are not allowed to access');
    }

    function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect('login');
    }

    function getAuthor($id)
    {
        return User::where('id', $id)->username;
    }

    function forgotPassword()
    {
        return view('email');
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $message = 'Sorry your email cannot be identified.';

        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;

            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }

        return redirect()->route('login')->with('message', $message);
    }


}
