<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\AdminProfile;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfilControllerAdmin extends Controller
{
    public function profil()
    {
        // Logic to retrieve and display profile data
        // This could involve fetching data from a model and passing it to a view
        $id_admin = Auth::user()->id; // Ambil ID admin dari user yang sedang login
        $admin = UserModel::where('role', 'admin')->where('id', $id_admin)->first(); // Assuming admin profile is stored with ID 1
        return view('admin.profil.profil', compact('admin')); // Adjust the view path as necessary
    }

    public function update(Request $request)
    {
        // Validasi input, password nullable
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6|confirmed', // pakai konfirmasi password
        ]);

        $id_admin = Auth::user()->id; // Ambil ID admin dari user yang sedang login
        $admin = UserModel::find($id_admin); // Ambil data admin berdasarkan ID

        if ($admin) {
            // Update data dasar
            $admin->email = $validated['email'];
            $admin->role = 'admin'; // Pastikan role admin

            // Jika password diisi, update password dengan hash
            if (!empty($validated['password'])) {
                $admin->password = Hash::make($validated['password']);
            }

            $admin->save();
        } else {
            // Buat data baru
            $dataCreate = [
                'id' => 1,
                'email' => $validated['email'],
                'role' => 'admin', // Pastikan role admin
            ];

            // Tambahkan password jika ada
            if (!empty($validated['password'])) {
                $dataCreate['password'] = Hash::make($validated['password']);
            }

            UserModel::create($dataCreate);
        }

        return redirect()->to('admin/profil')->with('success', 'Profil admin berhasil diperbarui.');
    }
}
