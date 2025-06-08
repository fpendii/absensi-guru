<?php

namespace Database\Seeders;

use App\Models\GuruModel;
use App\Models\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user guru
        $user = UserModel::create([
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('password'), // ganti dengan password aman
            'role' => 'guru',
        ]);

        // Buat data guru terkait user
        GuruModel::create([
            'user_id' => $user->id,
            'nama' => 'Ahmad Santoso',
            'nip' => '197812312020011001',
            'nuptk' => '1234567890123456',
            'telepon' => '08123456789',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1980-12-31',
            'alamat' => 'Jl. Melati No. 5',
            'foto' => null, // bisa diisi dengan path 'uploads/foto/ahmad.jpg'
            'mata_pelajaran' => 'Matematika',
            'pendidikan_terakhir' => 'S1',
            'status_pegawai' => 'PNS',
            'tanggal_masuk' => '2010-01-01',
        ]);
    }
}
