<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        $users = User::all(); // Retrieve all users or paginate if needed
        return response()->json($users);
    }

    // Store a newly created user
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'address' => 'required|string|max:255',
            'contactNumber' => 'required|string|max:15',
            'userType' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create a new user
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'contactNumber' => $request->contactNumber,
            'userType' => $request->userType,
            'avatar' => $request->avatar, // Optional avatar
        ]);

        return response()->json($user, 201); // Return the created user with a success response
    }

    // Display the specified user
    public function show(User $user)
    {
        return response()->json($user);
    }

    // Update the specified user
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed', // Password is optional during update
            'address' => 'required|string|max:255',
            'contactNumber' => 'required|string|max:15',
            'userType' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update the user
        $user->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'address' => $request->address,
            'contactNumber' => $request->contactNumber,
            'userType' => $request->userType,
            'avatar' => $request->avatar ?? $user->avatar, // Keep avatar if not updated
        ]);

        return response()->json($user);
    }

    // Remove the specified user
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
