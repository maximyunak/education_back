<?php

namespace App\Http\Middleware;

use App\Exceptions\Auth\ForbiddenException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (! in_array($user->role->name, $roles, true)) {
            // return response()->json(['error' => 'Forbidden'], 403);
            throw new ForbiddenException;
        }

        return $next($request);
    }
}
