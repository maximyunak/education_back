<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService) {}

    public function me(): JsonResponse
    {
        $user = auth()->user();

        return response()->json($user, 200);
    }
}
