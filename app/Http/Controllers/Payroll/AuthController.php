<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    
    public function index()
    {
        if (Auth::check()) {
            // The user is logged in, redirect to dashboard
            return redirect()->route('payroll-dashboard');
        }

        return view('payroll.auth.login');
    }   

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $checkLoginCred = $request->only('username', 'password');
        if (Auth::attempt($checkLoginCred)) {
            return redirect()->route('payroll-dashboard');
        }
        Session::flash('errorMessage', "Your login credentials are incorrect!");

        return redirect()->route('login');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
