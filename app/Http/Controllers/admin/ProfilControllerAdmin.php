<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\AdminProfile;
use Illuminate\Support\Facades\Hash;

class ProfilControllerAdmin extends Controller
{
    public function profil()
    {
        // Logic to retrieve and display profile data
        // This could involve fetching data from a model and passing it to a view
        $admin = UserModel::where('role', 'admin')->first(); // Assuming admin profile is stored with ID 1

        return view('admin.profil.profil', compact('admin')); // Adjust the view path as necessary
    }

    public function update(Request $request)
    {
        // Validasi input, password nullable
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6|confirmed', // pakai konfirmasi password
        ]);

        $admin = UserModel::find(1);

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
