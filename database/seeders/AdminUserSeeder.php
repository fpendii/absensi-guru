<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModel;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        UserModel::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('123'),
                'role' => 'admin',
            ]
        );
    }
}
