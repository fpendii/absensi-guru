<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModel;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        UserModel::updateOrCreate(
            ['email' => 'admin@gmail.com'],  // Cek jika sudah ada berdasarkan email
            [
                'name' => 'Admin',
                'password' => bcrypt('password123'), // Ganti dengan password yang kamu inginkan
                'role' => 'admin',
            ]
        );
    }
}
