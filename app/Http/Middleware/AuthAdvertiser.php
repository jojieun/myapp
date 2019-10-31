<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;

class AuthAdvertiser extends Middleware
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
        if (!Auth::guard('advertiser')->check()) {
//        return redirect()->route('advertiser_sessions.create');
        return redirect()->guest(route('advertiser_sessions.create'));
        }

        return $next($request);
    }
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('advertiser_sessions.create');
        }
    }
}
