<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::whereRaw('WEEKDAY(start_time) < 6')->get();
        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'teacher_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find or create the teacher by name
        $teacher = Teacher::firstOrCreate(['name' => $request->teacher_name]);

        $schedule = new Schedule();
        $schedule->title = $request->title;
        $schedule->description = $request->description;
        $schedule->day = $request->day;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->teacher_name = $request->teacher_name;
        $schedule->teacher_id = $teacher->id; // Set the teacher_id
        $schedule->save();

        return response()->json($schedule, 201);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'teacher_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find or create the teacher by name
        $teacher = Teacher::firstOrCreate(['name' => $request->teacher_name]);

        $schedule->update([
            'title' => $request->title,
            'description' => $request->description,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'teacher_name' => $request->teacher_name,
            'teacher_id' => $teacher->id, // Update the teacher_id
        ]);

        return response()->json($schedule, 200);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return response()->json(null, 204);
    }
}
