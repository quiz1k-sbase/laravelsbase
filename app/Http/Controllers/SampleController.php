<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            'confirm_password' => 'required|min:6'
        ]);
        $data = $request->all();
        $user = User::create([
            'username' => strip_tags($data['username']),
            'email' => $data['email'],
            'first_name' => strip_tags($data['first_name']),
            'last_name' => strip_tags($data['last_name']),
            'phone' => strip_tags($data['phone']),
            'password' => Hash::make($data['password'])
        ]);

        return redirect('login')->with('success', 'Registration completed. Sign in');
    }

    function validate_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials))
        {
            return redirect('dashboard');
        }

        return redirect('login')->with('success', 'Data are not valid');
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

        return Redirect('login');
    }

    function getAuthor($id)
    {
        return User::where('id', $id)->username;
    }
}
