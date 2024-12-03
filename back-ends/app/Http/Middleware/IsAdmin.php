<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->userType === 'admin') {
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden'], 403);  // Forbidden if not admin
    }
}

