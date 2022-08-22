<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(Auth::user()->level == $role){
            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
