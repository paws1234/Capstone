<?php
namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\ClassModel;
use App\Models\SchoolCalendar;


class HomeController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $teacherCount = Teacher::count();
        $subjectCount = Subject::count();
        $classCount = ClassModel::count();
        $schoolCalendars = SchoolCalendar::all();

  
        return response()->json([
            'studentCount' => $studentCount,
            'teacherCount' => $teacherCount,
            'subjectCount' => $subjectCount,
            'classCount' => $classCount,
            'schoolCalendars' => $schoolCalendars,
        ]);
    }

}
