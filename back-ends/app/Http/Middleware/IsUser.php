<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and is a regular user
        if (Auth::check() && Auth::user()->userType === 'user') {
            return $next($request); // Proceed if the user is a regular user
        }

        // If not a regular user, return unauthorized or redirect as needed
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
