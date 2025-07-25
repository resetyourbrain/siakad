<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            LecturerSeeder::class,
            StudentSeeder::class,
            CourseSeeder::class,
            StudentCourseSeeder::class,
            AssignmentSeeder::class,
            GradeSeeder::class,
            SubmissionSeeder::class,
        ]);
    }
}
