<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\ClassEnrollment;

class QrCodeData extends Model
{
    protected $table = 'qr_code_data';

    protected $fillable = ['qr_code', 'teacher_id']; 

    use HasFactory;

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }


    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
