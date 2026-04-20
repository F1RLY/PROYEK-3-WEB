<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'kode' => '2403065',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'firly',
            'kode' => '2403064',
            'email' => 'firly@gmail.com',
            'password' => Hash::make('firly123'),
            'role' => 'mahasiswa',
        ]);
    }
}
