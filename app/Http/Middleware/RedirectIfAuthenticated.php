<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->hasRole('root')) {
                return redirect(route('rootIndex'));
            } elseif (Auth::user()->hasRole('admin')) {
                return redirect(route('adminIndex'));
            } elseif (Auth::user()->hasRole('tester')) {
                return redirect(route('testerIndex'));
            } else {
                // return redirect('/logout');
            }

        }
        

        return $next($request);
    }
}
