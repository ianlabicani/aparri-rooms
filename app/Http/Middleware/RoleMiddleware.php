<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|string[]  $roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('login');
        }

        // Check if the user has the required role(s)
        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}

