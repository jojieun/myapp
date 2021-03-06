<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;

class AuthAdmin extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (!Auth::guard('admin')->check()) {
        return redirect()->guest(route('admin.login'));
        }
        if (Auth::guard('admin')->user()->authority < 1) {
        return redirect()->route('admin.no_permission');
        }

        return $next($request);
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('admin.login');
        }
    }
}
