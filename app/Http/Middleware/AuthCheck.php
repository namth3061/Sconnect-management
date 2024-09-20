<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('auth.login_via_kong')) {
            return app('App\Http\Middleware\AuthKong')->handle($request, $next);
        } else {
            return app('App\Http\Middleware\VerifyAuthToken')->handle($request, $next);
        }
    }
}
