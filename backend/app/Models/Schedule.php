<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'day',
        'teacher_name', 
        'teacher_id',   
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the teacher associated with the schedule.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($schedule) {
            $teacher = Teacher::where('name', $schedule->teacher_name)->first();

            if ($teacher) {
                $schedule->teacher_id = $teacher->id;
            } else {
                throw ValidationException::withMessages(['teacher_name' => 'Teacher not found.']);
            }
        });
    }
}
