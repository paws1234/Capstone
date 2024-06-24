<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $students = Student::all();
        $studentCount = $students->count();

        return response()->json(['students' => $students, 'studentCount' => $studentCount]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6',
        ]);

        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => 3,
        ]);
        $user->save();

        Student::create($validatedData);

        return response()->json(['message' => 'Student created successfully']);
    }

    public function edit(Student $student)
    {
        // You may not need to edit students in an API scenario
        // Return appropriate JSON response or HTTP status code
    }

    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
        ]);

        $student->update($validatedData);

        return response()->json(['message' => 'Student updated successfully']);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
