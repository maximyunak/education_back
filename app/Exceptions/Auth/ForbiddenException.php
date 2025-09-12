<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;

class ForbiddenException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'Недостаточно прав для выполнения действия',
            'type' => 'loh',
        ], 403);
    }
}
