<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request for API.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        // Validate the incoming credentials
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed, create a token
            $user = Auth::user();
            $token = $user->createToken('YourAppName')->plainTextToken;

            // Return the token in the response
            return response()->json([
                'token' => $token,
                'user' => $user,
            ], 200);
        }

        // If authentication fails, return an error response
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    /**
     * Destroy an authenticated session for API (log out).
     */
    public function destroy(Request $request): JsonResponse
    {
        // Check if the user is authenticated
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // Revoke the user's token
        $request->user()->currentAccessToken()->delete();

        // Return a success message
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
