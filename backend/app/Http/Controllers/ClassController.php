<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();
        return response()->json(['classes' => $classes]);
    }

    public function create()
    {
        // Since this is an API endpoint, creating a class does not require returning a view
        return response()->json(['message' => 'This action is not supported for API endpoints'], 405);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $class = ClassModel::create($validatedData);

        return response()->json(['class' => $class, 'message' => 'Class created successfully'], 201);
    }

    public function show(ClassModel $class)
    {
        return response()->json(['class' => $class]);
    }

    public function edit(ClassModel $class)
    {
        // Since this is an API endpoint, editing a class does not require returning a view
        return response()->json(['message' => 'This action is not supported for API endpoints'], 405);
    }

    public function update(Request $request, ClassModel $class)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $class->update($validatedData);

        return response()->json(['class' => $class, 'message' => 'Class updated successfully']);
    }

    public function destroy(ClassModel $class)
    {
        $class->delete();
        return response()->json(['message' => 'Class deleted successfully']);
    }
}
