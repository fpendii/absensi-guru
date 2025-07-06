<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RuangKelasModel;
use Illuminate\Http\Request;

class RuangKelasControllerAdmin extends Controller
{
    /**
     * Menampilkan daftar semua ruang kelas.
     */
    public function index()
    {
        $ruangKelas = RuangKelasModel::all();
        return view('admin.ruang-kelas.index', compact('ruangKelas'));
    }

    /**
     * Menampilkan formulir untuk membuat ruang kelas baru.
     */
    public function create()
    {
        return view('admin.ruang-kelas.create');
    }

    /**
     * Menyimpan ruang kelas baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:ruang_kelas,nama_kelas',
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique' => 'Nama kelas ini sudah ada.',
        ]);

        RuangKelasModel::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->to(url('admin/ruang-kelas'))->with('success', 'Ruang kelas berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail ruang kelas tertentu (opsional).
     */
    public function show(string $id)
    {
        // Tidak perlu diimplementasikan untuk CRUD sederhana
    }

    /**
     * Menampilkan formulir untuk mengedit ruang kelas tertentu.
     */
    public function edit(RuangKelasModel $ruang_kela)
    {
        return view('admin.ruang-kelas.edit', compact('ruang_kela'));
    }

    /**
     * Memperbarui ruang kelas tertentu di database.
     */
    public function update(Request $request, RuangKelasModel $ruang_kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255|unique:ruang_kelas,nama_kelas,' . $ruang_kela->id,
        ], [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique' => 'Nama kelas ini sudah ada.',
        ]);

        $ruang_kela->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->to(url('admin/ruang-kelas'))->with('success', 'Ruang kelas berhasil diperbarui!');
    }

    /**
     * Menghapus ruang kelas tertentu dari database.
     */
    public function destroy(RuangKelasModel $ruang_kela)
    {
        try {
            $ruang_kela->delete();
            return redirect()->to(url('admin/ruang-kelas'))->with('success', 'Ruang kelas berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->to(url('admin/ruang-kelas'))->with('error', 'Gagal menghapus ruang kelas karena ada data terkait.');
        }
    }
}
