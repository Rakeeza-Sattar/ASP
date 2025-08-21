<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackLastLogin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (!$user->last_login_at || $user->last_login_at->lt(now()->subMinutes(5))) {
                $user->update(['last_login_at' => now()]);
            }
        }

        return $next($request);
    }
}