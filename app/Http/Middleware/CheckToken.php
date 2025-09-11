<?php

namespace App\Http\Middleware;

use App\Exceptions\Auth\UnauthorizedException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $access_token = $request->cookie('access_token');
        try {
            $user = JWTAuth::setToken($access_token)->authenticate();
            if (! $user) {
                return throw new UnauthorizedException;
            }
        } catch (JWTException $ex) {
            return throw new UnauthorizedException;
        }

        auth()->login($user);

        return $next($request);
    }
}
