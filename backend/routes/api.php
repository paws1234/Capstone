<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolCalendarController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\RoomController;

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LogoutController::class, 'logout']);

Route::middleware(['auth:sanctum', 'cors', 'Admin'])->group(function () {
    Route::get('/admin/data', [HomeController::class, 'index']);
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');
    
    Route::get('/school-calendars', [SchoolCalendarController::class, 'index']);
    Route::post('/school-calendars', [SchoolCalendarController::class, 'store']);
    Route::get('/school-calendars/{event}', [SchoolCalendarController::class, 'show']);
    Route::put('/school-calendars/{event}', [SchoolCalendarController::class, 'update']);
    Route::delete('/school-calendars/{event}', [SchoolCalendarController::class, 'destroy']);

    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::post('/schedules', [ScheduleController::class, 'store']);
    Route::get('/schedules/{schedule}', [ScheduleController::class, 'show']);
    Route::put('/schedules/{schedule}', [ScheduleController::class, 'update']);
    Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy']);
    
});

Route::middleware(['auth:sanctum', 'cors', 'Teacher'])->group(function () {
    Route::put('rooms/{room}/occupy', [RoomController::class, 'occupy']);
    Route::put('rooms/{room}/vacate', [RoomController::class, 'vacate']);
    Route::get('rooms', [RoomController::class, 'index']);
    Route::post('rooms', [RoomController::class, 'store']);
    Route::get('rooms/{room}', [RoomController::class, 'show']);
    Route::put('rooms/{room}', [RoomController::class, 'update']);
    Route::delete('rooms/{room}', [RoomController::class, 'destroy']);
});



Route::middleware(['auth:sanctum', 'cors', 'Student'])->group(function () {
 
});