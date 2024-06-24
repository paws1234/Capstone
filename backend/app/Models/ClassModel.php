<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $fillable = ['name', 'teacher_id'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'class_student', 'class_id', 'student_id')->withTimestamps();
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function materials()
    {
        return $this->hasMany(ClassMaterial::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function SchoolCalendar()
    {
        return $this->hasMany(SchoolCalendar::class);
    }
   
}
