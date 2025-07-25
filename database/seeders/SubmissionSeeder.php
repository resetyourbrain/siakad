<?php

namespace Database\Seeders;

use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Submission::create([
            'assignment_id' => 1,
            'student_id' => 1,
            'file_path' => 'submission_files/report-dummy.pdf',
            'note' => 'Saya sudah mengumpulkan tugas.',
            'submitted_at' => Carbon::now(),
        ]);

        Submission::create([
            'assignment_id' => 1,
            'student_id' => 1,
            'file_path' => 'submission_files/report-dummy.pdf',
            'note' => 'Berikut adalah tugas yang saya kumpulkan.',
            'submitted_at' => Carbon::now(),
        ]);
    }
}
