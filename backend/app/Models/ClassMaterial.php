<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassMaterial extends Model
{
    protected $fillable = ['title', 'description', 'file_path', 'class_id'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
}
