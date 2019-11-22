<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;

class AuthBoth extends Middleware
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
        if (Auth::guard('advertiser')->check()||Auth::guard('web')->check()) {
            return $next($request);
        }
                return redirect()->route('sessions.create');
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('sessions.create');
        }
    }
}
