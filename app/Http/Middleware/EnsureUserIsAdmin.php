<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
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
       // dd("test");
       //dd(Auth::user()-role);
       $user=Auth::user();
       if(Auth::user()!=null && !Auth::user()->isAdmin())
            return abort(401);
        return $next($request);
    }
}
