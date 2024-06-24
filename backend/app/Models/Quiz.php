<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClassModel;
use App\Models\Teacher;
class Quiz extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'class_id','teacher_id'];
    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
}

