<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestaurantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has the admin role
        if (auth()->check() and auth()->user()->role_id == 'restaurant') {
            return $next($request);
        }

        // If not an admin, redirect or handle as needed
        return redirect()->route('login')->withErrors(['error' =>'You do not have permission to access this page.']);
    }
}
