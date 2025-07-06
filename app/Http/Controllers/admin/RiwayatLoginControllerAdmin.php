<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RiwayatLogin;
use Illuminate\Http\Request;
use App\Models\User; // Pastikan model User diimport

class RiwayatLoginControllerAdmin extends Controller
{
    /**
     * Menampilkan daftar riwayat login khusus admin.
     */
    public function index()
    {
        // Ambil riwayat login, eager load user, urutkan berdasarkan waktu login terbaru,
        // dan filter hanya untuk user dengan role 'admin'.
        $riwayatLogin = RiwayatLogin::with('user')
                                    ->latest('waktu_login')
                                    ->get();

        return view('admin.riwayat-login.index', compact('riwayatLogin'));
    }

    // Metode lain (create, store, show, edit, update, destroy) tidak relevan untuk riwayat login
}
