<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckGameOrigin
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
        $referer = $request->headers->get('X-referer') ?? '';
        $allowedOrigin = url('http://127.0.0.1:8000/game');
        if (!str_starts_with($referer, $allowedOrigin)) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }
        return $next($request);
    }
}
