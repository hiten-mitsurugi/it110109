<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{


    // Login method
   
    public function login(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
    
        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
    
            // Generate the token
            $token = $user->createToken('LaravelApp')->plainTextToken;
    
            // Return the response with token, user, and userType
            return response()->json([
                'message' => 'Login Successful',
                'token' => $token,
                'user' => $user,
            ]);
        }
    
        // If authentication fails
        return response()->json([
            'message' => 'Invalid credentials.',
        ], 401);
    }
    



    // Logout method
    public function logout(Request $request)
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return response()->json();
}



}
