<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CabinetAuthChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //dd($next);
        if (!\Auth::user()){
            return redirect()->route('front.index');
        }
        return $next($request);
    }
}
