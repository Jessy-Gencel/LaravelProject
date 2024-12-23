<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class CheckIfBlacklisted
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('blacklisted')) {
            return $next($request);
        }
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->blacklisted) {
                Log::info('Blocked User: ' . $user->id);
                return redirect()->route('blacklisted');
            }
        }
        return $next($request);

    }
}
