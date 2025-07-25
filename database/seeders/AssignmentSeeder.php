<?php

namespace Database\Seeders;

use App\Models\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Assignment::create([
            'title' => 'Tugas 1 - Web',
            'description' => 'Buat form login dan register',
            'tanggal_dibuat' => now(),
            'tanggal_deadline' => now()->addDays(5),
            'course_id' => 1,
        ]);

        Assignment::create([
            'title' => 'Tugas 1 - Basis Data',
            'description' => 'ERD dan relasi tabel',
            'tanggal_dibuat' => now(),
            'tanggal_deadline' => now()->addDays(7),
            'course_id' => 2,
        ]);
    }
}
