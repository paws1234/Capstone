<?php
namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return response()->json(['teachers' => $teachers]);
    }
    

    public function create()
    {
       
        return response()->json(['message' => 'Method not supported'], 405);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'required|string|min:6',
        ]);

        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'is_admin' => 2,
        ]);
        $user->save();

        Teacher::create($validatedData);

        return response()->json(['message' => 'Teacher created successfully'], 201);
    }

    public function edit(Teacher $teacher)
    {
      
        return response()->json(['message' => 'Method not supported'], 405);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
        ]);

        $teacher->update($validatedData);

        $user = User::where('email', $teacher->email)->first();
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
        }

        return response()->json(['message' => 'Teacher updated successfully']);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        $user = User::where('email', $teacher->email)->first();
        if ($user) {
            $user->delete();
        }

        return response()->json(['message' => 'Teacher deleted successfully']);
    }
}
