<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        $type_user = auth()->user()->type_user;
        if($type_user!=1){
            return redirect(route('home'));
        }
        return $next($request);
    }
}
