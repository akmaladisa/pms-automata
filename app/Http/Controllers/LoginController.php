<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view("auth.login");
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => 'required|email',
            "password" => 'required'
        ]);

        if( Auth::attempt( $credentials ) )
        {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', "Success Login!");
        }

        return redirect("/")->withErrors([
            'email' => "Email Atau Password Salah",
            'password' => "Password Atau Email Salah",
        ]);
    }

    public function dashboard()
    {
        return view("dashboard.dashboard");
    }

    public function logout()
    {
        Auth::logout();

        session()->flush();
    
        return redirect('/');
    }

}
