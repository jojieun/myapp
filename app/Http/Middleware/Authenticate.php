<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Route;

class Authenticate extends Middleware
{
    /*
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
//            if (array_first($this->guards) === 'advertiser') {
//                return route('advertiser_sessions.create');
//            }
//            dd($request->route()->uri);
//            if(Route::is('advertiser.*')){
//                
//                return route('advertiser_sessions.create');
//            }
//            dd('여기');
            return route('sessions.create');

        }
    }
}
