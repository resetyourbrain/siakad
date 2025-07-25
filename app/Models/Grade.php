<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['student_course_id', 'nilai'];

    public function studentCourse()
    {
        return $this->belongsTo(StudentCourse::class);
    }
}
