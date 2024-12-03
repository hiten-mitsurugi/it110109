<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;  // Import JsonResponse

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse  // Change the return type to JsonResponse
    {
        // Validation rules
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'contactNumber' => ['nullable', 'string', 'regex:/^\+?\d{7,15}$/'],
            'userType' => ['nullable', 'string', 'in:user,admin'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class, 
                        'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,7}$/'],
            'password' => ['required', 'confirmed', 
                           'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
        ]);

        try {
            // Create user
            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'address' => $request->address,
                'contactNumber' => $request->contactNumber,
                'userType' => $request->userType ?? 'user', // Default to 'user'
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Trigger registered event
            event(new Registered($user));

            // Log the user in
            Auth::login($user);

            // Return success response with 201 status
            return response()->json(['message' => 'Registered successfully'], 201);
        } catch (\Exception $e) {
            // Log exception (optional, for debugging)
            \Log::error('Registration Error: ' . $e->getMessage());

            // Return error response with 500 status
            return response()->json(['message' => 'Registration failed. Please try again.'], 500);
        }
    }
}
