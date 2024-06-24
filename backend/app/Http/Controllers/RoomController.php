<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Schedule;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return response()->json($rooms);
    }

    /**
     * Display the specified room.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return response()->json($room);
    }

    /**
     * Store a newly created room.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'schedule_title' => 'nullable|string|exists:schedules,title',
        ]);

        $teacher = Teacher::where('name', Auth::user()->name)->firstOrFail();

        $room = new Room();
        $room->name = $request->name;
        $room->occupied = false; // Automatically set to not occupied
        if ($request->has('schedule_title')) {
            $schedule = Schedule::where('title', $request->schedule_title)->first();
            if ($schedule) {
                $room->schedule_id = $schedule->id;
            }
        }
        $room->teacher_id = $teacher->id; // Set the current user's teacher ID
        $room->save();

        return response()->json($room, 201);
    }

    /**
     * Update the specified room.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'occupied' => 'required|boolean',
            'schedule_title' => 'nullable|string|exists:schedules,title',
        ]);

        $teacher = Teacher::where('name', Auth::user()->name)->firstOrFail();

        $room->name = $request->name;
        $room->occupied = $request->occupied;
        if ($request->has('schedule_title')) {
            $schedule = Schedule::where('title', $request->schedule_title)->first();
            if ($schedule) {
                $room->schedule_id = $schedule->id;
            }
        }
        $room->teacher_id = $teacher->id; // Ensure the teacher ID is the current user's teacher ID
        $room->save();

        return response()->json($room, 200);
    }

    /**
     * Remove the specified room from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(null, 204);
    }

    /**
     * Occupies the specified room.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function occupy(Room $room)
    {
        $teacher = Teacher::where('name', Auth::user()->name)->firstOrFail();

        if ($room->teacher_id === $teacher->id || ($room->schedule && $room->schedule->teacher_id === $teacher->id)) {
            $room->occupied = true;
            $room->save();
            return response()->json($room, 200);
        } else {
            return response()->json(['error' => 'You are not authorized to occupy this room.'], 403);
        }
    }

    /**
     * Vacates the specified room.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function vacate(Room $room)
    {
        $teacher = Teacher::where('name', Auth::user()->name)->firstOrFail();

        if ($room->teacher_id === $teacher->id || ($room->schedule && $room->schedule->teacher_id === $teacher->id)) {
            $room->occupied = false;
            $room->save();
            return response()->json($room, 200);
        } else {
            return response()->json(['error' => 'You are not authorized to vacate this room.'], 403);
        }
    }
}
