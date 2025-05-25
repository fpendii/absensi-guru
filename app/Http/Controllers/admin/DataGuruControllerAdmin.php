<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GuruModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class DataGuruControllerAdmin extends Controller
{
    public function dataGuru()
    {
        // Fetch all data from the GuruModel
        $dataGuru = GuruModel::with('user')->get();


        return view('admin.data-guru.data-guru', compact('dataGuru'));
    }

    public function create()
    {
        // Show the form to create a new Guru
        return view('admin.data-guru.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|string|min:6|confirmed',
        //     'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        //     'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        //     // validasi tambahan bisa ditambahkan sesuai kebutuhan
        // ]);

        // Simpan data ke tabel users
        $user = UserModel::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        // Simpan foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_guru', 'public');
        }

        // Simpan data ke tabel guru
        GuruModel::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'nuptk' => $request->nuptk,
            'telepon' => $request->telepon,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'foto' => $fotoPath,
            'mata_pelajaran' => $request->mata_pelajaran,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'status_pegawai' => $request->status_pegawai,
            'tanggal_masuk' => $request->tanggal_masuk,
            'user_id' => $user->id,
        ]);

        return redirect('/admin/data-guru')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Cari guru berdasarkan ID, termasuk data user-nya
        $guru = GuruModel::with('user')->findOrFail($id);

        return view('admin.data-guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diperlukan
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'nullable|min:6',
        //     'nama' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        // ]);

        // Ambil data guru dan user
        $guru = GuruModel::with('user')->findOrFail($id);
        $user = $guru->user;

        // Update data user
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Handle upload foto jika ada
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('foto_guru'), $namaFoto);
            $guru->foto = $namaFoto;
        }

        // Update data guru
        $guru->nama = $request->nama;
        $guru->nip = $request->nip;
        $guru->nuptk = $request->nuptk;
        $guru->telepon = $request->telepon;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->tempat_lahir = $request->tempat_lahir;
        $guru->tanggal_lahir = $request->tanggal_lahir;
        $guru->alamat = $request->alamat;
        $guru->mata_pelajaran = $request->mata_pelajaran;
        $guru->pendidikan_terakhir = $request->pendidikan_terakhir;
        $guru->status_pegawai = $request->status_pegawai;
        $guru->tanggal_masuk = $request->tanggal_masuk;

        $guru->save();

        return redirect('/admin/data-guru')->with('success', 'Data guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cari guru berdasarkan ID
        $guru = GuruModel::findOrFail($id);

        // Hapus foto jika ada
        if ($guru->foto) {
            $fotoPath = public_path('foto_guru/' . $guru->foto);
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
        }

        // Hapus data guru
        $guru->delete();

        // Hapus data user terkait
        UserModel::where('id', $guru->user_id)->delete();

        return redirect('/admin/data-guru')->with('success', 'Data guru berhasil dihapus');
    }
}
