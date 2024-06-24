<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use App\Models\Room;
use App\Policies\RoomPolicy;
class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Room::class => RoomPolicy::class,
    ];

    public function boot()
    {
        
    }
}
