<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        //dd(Auth::user()->getRole(Auth::user()->id));
        foreach ($guards as $guard) {
            //dd(Auth::guard($guard)->user()->id);
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::ADMIN);
            }
        }

        return $next($request);
    }
}
