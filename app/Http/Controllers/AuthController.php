<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Ambil user yang sedang login
            $user = Auth::user();

            // Arahkan berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('/admin/data-guru');
                case 'guru':
                    return redirect()->intended('/guru/data-absensi');
                default:
                    return redirect()->intended('/dashboard'); // default jika tidak cocok
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
