<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'score', 
        'student_id', 
        'quiz_id',
        'teacher_id',
    ];
    public function quiz()
{
    return $this->belongsTo(Quiz::class);
}
}
