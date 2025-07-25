<?php

namespace Database\Seeders;

use App\Models\StudentCourse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        StudentCourse::create([
            'student_id' => 1,
            'course_id' => 1,
        ]);

        StudentCourse::create([
            'student_id' => 1,
            'course_id' => 2,
        ]);
    }
}
