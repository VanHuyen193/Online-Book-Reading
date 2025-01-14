<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin1@example.com',
            'password' => bcrypt('password'), // Mật khẩu
            'is_admin' => true, // Đánh dấu là admin
        ]);
    }
}
