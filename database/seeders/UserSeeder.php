<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        UserModel::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Guru
        UserModel::create([
            'name' => 'Ahmad Santoso',
            'email' => 'ahmad@example.com',
            'username' => 'ahmad',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);
    }
}
