<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
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
//        return $next($request);

        if (Auth::check()) {
//            dd(Auth::user()->roles);
            if(Auth::user()->roles == 1) {
                return $next($request);
            }
            if(Auth::user()->roles == 0){
                return redirect('login');
            }
        }
        else
            return redirect('login');

    }
}
