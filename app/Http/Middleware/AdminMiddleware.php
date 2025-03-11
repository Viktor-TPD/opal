<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect('/')->with('status', 'Access denied. Admin privileges required.')
                ->with('status_type', 'error-container');
        }

        return $next($request);
    }
}
