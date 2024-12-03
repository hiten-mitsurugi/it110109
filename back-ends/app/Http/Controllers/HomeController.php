<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the home redirection after login.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ensure the user is authenticated
        if (Auth::check()) {
            // Get the authenticated user
            $user = Auth::user();

            // Check the user type and redirect accordingly
            if ($user->userType === 'admin') {
                // If admin, return a response indicating an admin home
                return response()->json([
                    'redirect_to' => 'AdminHome'
                ]);
            } else {
                // If normal user, return a response indicating a user home
                return response()->json([
                    'redirect_to' => 'UserHome'
                ]);
            }
        }

        // If not authenticated, return an unauthorized response
        return response()->json([
            'message' => 'Unauthorized'
        ], 401);
    }
}
