<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Get admin-specific data (e.g., dashboard, stats, etc.).
     */
    public function __construct()
    {
        // Apply Sanctum authentication middleware
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        // Ensure the user is an admin before proceeding
        if ($request->user()->userType !== 'admin') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json(['message' => 'Welcome to the admin dashboard']);
    }
}
