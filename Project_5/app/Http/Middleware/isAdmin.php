<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::check() && Auth::guard('web')->user()->role_id == 1){

            // return redirect(route("user.dashboard"));
            return $next($request);

        }

        elseif(Auth::check() && Auth::guard('admins')->user()->role_id == 2){

            return redirect(route("admin.dashboard"));
            // return $next($request);

        }



        return $next($request);
    }
}