<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
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
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized: Please log in'], 401);
        }

        // Check if the authenticated user is an admin
        $user = Auth::user();

        if (!$user->is_admin) {
            return response()->json(['message' => 'Forbidden: Access restricted to administrators'], 403);
        }

        return $next($request);
    }
}
