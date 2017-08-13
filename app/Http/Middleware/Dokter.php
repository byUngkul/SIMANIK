<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Dokter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'dokter')
    {
        if (Auth::guard($guard)->check() && Auth::guard($guard)->user()->level == 'dokter') {
            return $next($request);
        }
        return redirect()->back();
    }
}
