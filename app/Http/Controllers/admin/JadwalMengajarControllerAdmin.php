<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalMengajarModel;
use App\Models\GuruModel;
use App\Models\MataPelajaranModel;
use App\Models\RuangKelasModel; // Import Model RuangKelasModel
use Illuminate\Http\Request;

class JadwalMengajarControllerAdmin extends Controller
{
    /**
     * Menampilkan daftar semua jadwal mengajar.
     */
    public function index()
    {
        // Ambil semua jadwal dengan relasi guru dan mata pelajaran
        // Tidak perlu eager load 'ruangan' karena 'ruangan_kelas' adalah string
        $schedules = JadwalMengajarModel::with(['guru', 'mapel'])->get();

        return view('admin.jadwal-mengajar.index', compact('schedules'));
    }

    /**
     * Menampilkan formulir untuk membuat jadwal mengajar baru.
     */
    public function create()
    {
        $guru = GuruModel::all(); // Ambil semua guru untuk dropdown
        $mataPelajaran = MataPelajaranModel::all(); // Ambil semua mata pelajaran untuk dropdown
        $ruanganKelas = RuangKelasModel::all(); // Ambil semua ruang kelas untuk dropdown
        return view('admin.jadwal-mengajar.create', compact('guru', 'mataPelajaran', 'ruanganKelas'));
    }

    /**
     * Menyimpan jadwal mengajar baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_guru' => 'required|exists:guru,id',
            'id_mapel' => 'required|exists:mata_pelajaran,id',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'id_ruang_kelas' => 'required|exists:ruang_kelas,id', // Validasi ID ruang kelas
        ]);

        // Ambil nama kelas berdasarkan ID yang dipilih
        $namaRuangKelas = RuangKelasModel::findOrFail($request->id_ruang_kelas)->nama_kelas;

        JadwalMengajarModel::create([
            'id_guru' => $request->id_guru,
            'id_mapel' => $request->id_mapel,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan_kelas' => $namaRuangKelas, // Simpan nama kelas ke kolom string
        ]);

        return redirect()->to('admin/jadwal-mengajar')->with('success', 'Jadwal mengajar berhasil ditambahkan!'); // Perbaiki URL redirect
    }

    /**
     * Menampilkan detail jadwal mengajar tertentu.
     */
    public function show(string $id)
    {
        // Jika Anda perlu halaman detail jadwal, implementasikan di sini
    }

    /**
     * Menampilkan formulir untuk mengedit jadwal mengajar tertentu.
     */
    public function edit($id)
    {
        $guru = GuruModel::all();
        $mataPelajaran = MataPelajaranModel::all();
        $ruanganKelas = RuangKelasModel::all(); // Ambil semua ruang kelas untuk dropdown
        $jadwal_mengajar = JadwalMengajarModel::with(['guru', 'mapel'])->findOrFail($id);

        return view('admin.jadwal-mengajar.edit', compact('jadwal_mengajar', 'guru', 'mataPelajaran', 'ruanganKelas'));
    }

    /**
     * Memperbarui jadwal mengajar tertentu di database.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'id_guru' => 'required|exists:guru,id',
            'id_mapel' => 'required|exists:mata_pelajaran,id',
            'hari' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'id_ruang_kelas' => 'required|exists:ruang_kelas,id', // Validasi ID ruang kelas
        ]);

        // Ambil nama kelas berdasarkan ID yang dipilih
        $namaRuangKelas = RuangKelasModel::findOrFail($request->id_ruang_kelas)->nama_kelas;

        $jadwal_mengajar = JadwalMengajarModel::findOrFail($id);
        $jadwal_mengajar->update([
            'id_guru' => $request->id_guru,
            'id_mapel' => $request->id_mapel,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan_kelas' => $namaRuangKelas, // Simpan nama kelas ke kolom string
        ]);

        return redirect()->to('admin/jadwal-mengajar')->with('success', 'Jadwal mengajar berhasil diperbarui!'); // Perbaiki URL redirect
    }

    /**
     * Menghapus jadwal mengajar tertentu dari database.
     */
    public function destroy($id)
    {
        $jadwal_mengajar = JadwalMengajarModel::findOrFail($id);
        $jadwal_mengajar->delete();
        return redirect()->to('admin/jadwal-mengajar')->with('success', 'Jadwal mengajar berhasil dihapus!'); // Perbaiki URL redirect
    }
}
