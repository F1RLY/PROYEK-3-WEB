<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Users;

class addDosen extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosenData = [
            'nama' => 'Muhamad Mustamiin, S.Pd.,M.Kom.',
            'kode' => '72103939',
            'role' => 'dosen',
            'email' => 'hehe@gmail.com',
            'password' => bcrypt('taplakmeja'),
            'created_at' => date("Y-m-d H:m:s"),
            'updated_at' => date("Y-m-d H:m:s")
        ];

        Users::create($dosenData);

    }
}
