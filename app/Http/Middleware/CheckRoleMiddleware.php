<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // If user is not logged in, redirect to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // If no specific roles are required, allow access
        if (empty($roles)) {
            return $next($request);
        }

        $userRole = Auth::user()->role;

        // Check if user has one of the required roles
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Redirect based on user's role
        if ($userRole === 'Admin') {
            
            // Only redirect if not already on admin dashboard
            if (!$request->routeIs('AdminDashboard')) {
                return redirect()->route('AdminDashboard');
            }
        } elseif ($userRole === 'Sales Manager') {
            // Only redirect if not already on sales manager dashboard
            if (!$request->routeIs('SaleManagerDashboard')) {
                return redirect()->route('SaleManagerDashboard');
            }
        }

        // If we get here, user is on correct dashboard but trying to access unauthorized route
        abort(403, 'Unauthorized action.');
    }
}

