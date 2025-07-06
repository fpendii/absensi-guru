<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaranModel; // Import Model MataPelajaran
use Illuminate\Http\Request;

class MataPelajaranControllerAdmin extends Controller
{
    /**
     * Menampilkan daftar semua mata pelajaran.
     */
    public function index()
    {
        $mataPelajaran = MataPelajaranModel::all(); // Ambil semua data mata pelajaran
        return view('admin.mata-pelajaran.index', compact('mataPelajaran'));
    }

    /**
     * Menampilkan formulir untuk membuat mata pelajaran baru.
     */
    public function create()
    {
        return view('admin.mata-pelajaran.create');
    }

    /**
     * Menyimpan mata pelajaran baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255|unique:mata_pelajaran,nama_mapel', // Nama mapel harus unik
        ], [
            'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
            'nama_mapel.unique' => 'Nama mata pelajaran ini sudah ada.',
        ]);

        MataPelajaranModel::create([
            'nama_mapel' => $request->nama_mapel,
        ]);

        return redirect()->to('admin/mata-pelajaran')->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail mata pelajaran tertentu (opsional, jarang digunakan untuk entitas sederhana).
     */
    public function show(string $id)
    {
        // Jika diperlukan, implementasikan di sini
    }

    /**
     * Menampilkan formulir untuk mengedit mata pelajaran tertentu.
     */
    public function edit(MataPelajaranModel $mata_pelajaran) // Menggunakan Route Model Binding
    {
        // Variabel $mata_pelajaran secara otomatis berisi instance MataPelajaran berdasarkan ID dari URL
        return view('admin.mata-pelajaran.edit', compact('mata_pelajaran'));
    }

    /**
     * Memperbarui mata pelajaran tertentu di database.
     */
    public function update(Request $request, MataPelajaranModel $mata_pelajaran) // Menggunakan Route Model Binding
    {
        $request->validate([
            'nama_mapel' => 'required|string|max:255|unique:mata_pelajaran,nama_mapel,' . $mata_pelajaran->id, // Unik kecuali untuk ID sendiri
        ], [
            'nama_mapel.required' => 'Nama mata pelajaran wajib diisi.',
            'nama_mapel.unique' => 'Nama mata pelajaran ini sudah ada.',
        ]);

        $mata_pelajaran->update([
            'nama_mapel' => $request->nama_mapel,
        ]);

        return redirect()->to('admin/mata-pelajaran')->with('success', 'Mata pelajaran berhasil diperbarui!');
    }

    /**
     * Menghapus mata pelajaran tertentu dari database.
     */
    public function destroy(MataPelajaranModel $mata_pelajaran) // Menggunakan Route Model Binding
    {
        try {
            $mata_pelajaran->delete();
            return redirect()->to('admin/mata-pelajaran')->with('success', 'Mata pelajaran berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangani jika ada data terkait (misal di jadwal_mengajar)
            return redirect()->to('admin/mata-pelajaran')->with('error', 'Gagal menghapus mata pelajaran karena ada data jadwal mengajar yang terkait. Harap hapus jadwal terkait terlebih dahulu.');
        }
    }
}
