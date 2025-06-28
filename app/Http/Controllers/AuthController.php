<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate user
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/mahasiswa')->with('success', 'Login successful!');
        }

        return redirect()->back()->withErrors(['email' => 'Email atau password salah!'])->withInput();
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('login')->with('success', 'Logout successfully');
    }
}