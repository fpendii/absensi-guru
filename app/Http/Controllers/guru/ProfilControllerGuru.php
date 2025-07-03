<?php

namespace App\Http\Controllers\guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GuruModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class ProfilControllerGuru extends Controller
{
    public function profil()
    {
        $id_guru = Auth::user()->id;
        $guru = GuruModel::where('user_id', $id_guru)->join('users', 'guru.user_id', '=', 'users.id')->first();

        return view('guru.profil.profil', compact('guru'));
    }

    public function update(Request $request)
    {
        $id_user = Auth::id();
        $guru = GuruModel::where('user_id', $id_user)->first();
        $user = UserModel::find($id_user);

        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'nuptk' => 'nullable|string|max:50',
            'telepon' => 'nullable|string|max:20',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'mata_pelajaran' => 'nullable|string|max:100',
            'pendidikan_terakhir' => 'nullable|string|max:100',
            'status_pegawai' => 'nullable|string|max:100',
            'tanggal_masuk' => 'nullable|date',
            'email' => 'required|email|unique:users,email,' . $id_user,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        // Update ke tabel `guru`
        if ($guru) {
            $guru->update([
                'nama' => $validated['nama'],
                'nip' => $validated['nip'] ?? null,
                'nuptk' => $validated['nuptk'] ?? null,
                'telepon' => $validated['telepon'] ?? null,
                'jenis_kelamin' => $validated['jenis_kelamin'] ?? null,
                'tempat_lahir' => $validated['tempat_lahir'] ?? null,
                'alamat' => $validated['alamat'] ?? null,
                'mata_pelajaran' => $validated['mata_pelajaran'] ?? null,
                'pendidikan_terakhir' => $validated['pendidikan_terakhir'] ?? null,
                'status_pegawai' => $validated['status_pegawai'] ?? null,
                'tanggal_masuk' => $validated['tanggal_masuk'] ?? null,
            ]);
        }

        // Update ke tabel `users`
        if ($user) {
            $user->email = $validated['email'];
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }
            $user->save();
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
