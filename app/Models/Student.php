<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nim', 'jurusan', 'angkatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentCourses()
    {
        return $this->hasMany(StudentCourse::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
