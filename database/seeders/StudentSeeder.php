<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Student::create([
            'user_id' => 2,
            'nim' => '2024001',
            'jurusan' => 'Teknik Informatika',
            'angkatan' => '2024',
        ]);
    }
}
