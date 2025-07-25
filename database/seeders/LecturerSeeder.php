<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Lecturer::create([
            'user_id' => 1,
            'nidn' => '011001',
            'prodi' => 'Teknik Informatika',
        ]);
    }
}
