<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;

class UnauthorizedException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'Unauthorized',
            'type' => 'Unauthorized',
        ], 401);
    }
}
