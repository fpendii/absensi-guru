<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalMengajarModel;
use App\Models\GuruModel; // Asumsi GuruModel memiliki relasi ke User atau kolom user_id
use App\Models\MataPelajaranModel;
use App\Models\RuangKelasModel; // Meskipun tidak digunakan di index, biarkan saja importnya

class JadwalMengajarControllerGuru extends Controller
{
    /**
     * Menampilkan daftar jadwal mengajar untuk guru yang sedang login.
     */
    public function index()
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Cari ID guru berdasarkan ID user yang login
        // Asumsi ada kolom 'user_id' di tabel 'guru' yang terhubung ke 'id' di tabel 'users'
        $guru = GuruModel::where('user_id', $userId)->first();

        // Jika guru tidak ditemukan atau belum terhubung dengan user
        if (!$guru) {
            // Bisa redirect atau tampilkan pesan error
            return redirect('/')->with('error', 'Data guru Anda tidak ditemukan. Harap hubungi administrator.');
        }

        // Ambil jadwal mengajar khusus untuk guru ini
        $schedules = JadwalMengajarModel::with(['mapel'])
                                        ->where('id_guru', $guru->id)
                                        ->latest('hari') // Urutkan biar rapi
                                        ->latest('jam_mulai')
                                        ->get();

        return view('guru.jadwal-mengajar.index', compact('schedules'));
    }

    // Metode 'edit' dan 'update' dihapus karena guru tidak memiliki akses untuk mengedit jadwal.
    // public function edit(JadwalMengajarModel $jadwal_mengajar) { ... }
    // public function update(Request $request, JadwalMengajarModel $jadwal_mengajar) { ... }
}
