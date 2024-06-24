<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
 
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('User object:', ['user' => $request->user()]);
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        if ($user->role != 1) {
            return response()->json(['error' => 'You do not have admin privileges.'], 406);
        }

        return $next($request);
    }
}
