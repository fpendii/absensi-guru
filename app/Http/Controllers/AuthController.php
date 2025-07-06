<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatLogin; // Import model RiwayatLogin

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

            // --- Logika Pencatatan Riwayat Login (Ditambahkan di sini) ---
            RiwayatLogin::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(), // Mengambil IP address dari request
                'user_agent' => $request->header('User-Agent'), // Mengambil User Agent dari request header
                // 'waktu_login' akan otomatis diisi oleh default SQL CURRENT_TIMESTAMP atau created_at di model/migrasi
            ]);
            // -----------------------------------------------------------

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
