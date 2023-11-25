<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if last activity is within the allowed time
            if (Carbon::parse($user->last_activity_at)->addMinutes(config('auth.guards.web.expire'))->isPast()) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['error'=> 'Your session has expired. Please log in again.']);
            }

            // Update last activity timestamp
            $user->recordActivity();
        }

        return $next($request);
    }
}
