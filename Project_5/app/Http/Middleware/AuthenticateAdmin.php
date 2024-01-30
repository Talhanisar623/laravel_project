<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateAdmin extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {


// dd(! $request->expectsJson());

        if (! $request->expectsJson()) {
dd(route('auth.admin.login'));

            return route('auth.admin.login');





        }
    }
}