<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        return $next($request);
        if (Auth::check()) {
//            dd(Auth::user()->name);
            if (Auth::user()->name == 'admin') {
                return $next($request);
            } else
                return redirect()->route('news.list')->with('error', 'Bạn ko có quyền xem trang đấy!');


        }
    }
}
