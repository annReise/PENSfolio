<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // pastikan user sudah login
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403); // Forbidden
        }

        return $next($request);
    }
}
