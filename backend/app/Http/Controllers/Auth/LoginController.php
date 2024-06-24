<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    
    protected $redirectTo = 'http://localhost:8080/';

    public function login(Request $request)
    {
  
        $credentials = $request->only('email', 'password');
    
     
        if (!Auth::attempt($credentials)) {
            // Return error response if authentication fails
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    
      
        $user = Auth::user();

    
        $token = $user->createToken('token-name')->plainTextToken;

    
        switch ($user->role) {
            case 1:
                return response()->json(['token' => $token, 'role' => 1, 'message' => 'Role 1 user logged in'], 200);
            case 2:
                return response()->json(['token' => $token, 'role' => 2, 'message' => 'Role 2 user logged in'], 200);
            case 3:
                return response()->json(['token' => $token, 'role' => 3, 'message' => 'Role 3 user logged in'], 200);
            default:
                return response()->json(['message' => 'User role not recognized'], 400);
        }
    }
}
