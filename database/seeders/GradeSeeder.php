<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Grade::create([
            'student_course_id' => 1,
            'nilai' => 'A',
        ]);

        Grade::create([
            'student_course_id' => 2,
            'nilai' => 'B+',
        ]);
    }
}
