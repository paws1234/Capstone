<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'content', 'class_id','teacher_id'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
