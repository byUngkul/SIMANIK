<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Resepsionist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'resepsionist')
    {   
        // dd(Auth::guard($guard)->check());
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->level == 'resepsionist') {
            return $next($request);
        }
        return redirect()->back();
    }
}
