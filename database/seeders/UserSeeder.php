<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dosen
        User::create([
            'name' => 'Dr. Budi Santoso',
            'username' => 'dosen1',
            'password' => bcrypt('dosen1'),
            'phone' => '081234567890',
            'email' => 'budi@dosen.com',
            'role' => 'dosen',
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Agus Salim',
            'username' => 'mahasiswa1',
            'password' => bcrypt('mahasiswa1'),
            'phone' => '085678901234',
            'email' => 'agus@student.com',
            'role' => 'mahasiswa',
        ]);
    }
}
