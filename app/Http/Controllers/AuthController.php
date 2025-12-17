<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'email' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {
            // ✅ تسجيل دخول ناجح
            return redirect()->route('home');
        }

        // ❌ بيانات خاطئة
        return back()->withErrors([
            'login_error' => 'Invalid username or password',
        ]);
    }
}
