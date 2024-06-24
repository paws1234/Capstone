<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SchoolCalendar;
use Illuminate\Http\Request;

class SchoolCalendarController extends Controller
{
    public function index()
    {
        $schoolCalendars = SchoolCalendar::all();
        return response()->json(['schoolCalendars' => $schoolCalendars]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        $schoolCalendar = SchoolCalendar::create($validatedData);

        return response()->json(['schoolCalendar' => $schoolCalendar, 'message' => 'Event created successfully'], 201);
    }

    public function show(SchoolCalendar $event)
    {
        return response()->json(['event' => $event]);
    }

    public function update(Request $request, SchoolCalendar $event)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        $event->update($validatedData);

        return response()->json(['event' => $event, 'message' => 'Event updated successfully']);
    }

    public function destroy(SchoolCalendar $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
