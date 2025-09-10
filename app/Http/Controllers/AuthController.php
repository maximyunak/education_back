<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = $request->toDTO();
        $user = $this->authService->register($dto);

        return response()->json([
            'message' => 'Success',
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $dto = $request->toDTO();

        $data = $this->authService->login($dto);

        return response()->json($data, 200)->withCookies($data['cookies']);
    }

    public function user()
    {
        $user = $this->authService->getUser();
        // $user = JWTAuth::parseToken()->authenticate();

        return response()->json([
            'user' => $user,
        ], 200);
    }

    public function refresh()
    {
        $data = $this->authService->refresh();

        return response()->json([
            'user' => $data['user'],
            'token' => $data['token'],
        ], 200);
    }
}
