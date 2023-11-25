<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {
            // Check if the user is authenticated and has the admin role
            if (auth()->check() and auth()->user()->role_id == 'admin') {
                return $next($request);
            }

            // If not an admin, redirect or handle as needed
            return redirect()->route('login')->withErrors(['error' =>'You do not have permission to access this page.']);
        }
    }
}
