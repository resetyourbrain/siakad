<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Course::create([
            'kode' => 'IF3201',
            'nama' => 'Pemrograman Web',
            'sks' => '4',
            'semester' => '3',
            'lecturer_id' => 1,
        ]);

        Course::create([
            'kode' => 'IF3202',
            'nama' => 'Basis Data',
            'sks' => '2',
            'semester' => '3',
            'lecturer_id' => 1,
        ]);
    }
}
