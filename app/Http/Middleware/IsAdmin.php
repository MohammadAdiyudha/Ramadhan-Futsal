<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // auth check untuk mengatasi Trying to get property 'is_admin' of non-object ketika tidak login
        if(auth()->check() && auth()->user()->is_admin == 1){
            return $next($request);
        }

        return back()->with('error','Ups, Kamu Bukan Admin');
    }
}
