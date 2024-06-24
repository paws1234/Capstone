<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        \Log::info('User object:', ['user' => $request->user()]);
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        if ($user->role != 3) {
            return response()->json(['error' => 'You do not have Student privileges.'], 404);
        }

        return $next($request);
    }
    
}

