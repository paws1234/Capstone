<?php

namespace App\Policies;

use App\Models\User; // assuming you have a User model for authentication
use App\Models\Room;
use Illuminate\Auth\Access\HandlesAuthorization;

class RoomPolicy
{
    use HandlesAuthorization;

    public function occupy(User $user, Room $room)
    {
        // Only allow teachers to occupy rooms
        return $user->is_teacher && $room->schedule->teacher_id === $user->id;
    }

    public function vacate(User $user, Room $room)
    {
        // Only allow teachers to vacate rooms
        return $user->is_teacher && $room->schedule->teacher_id === $user->id;
    }
}