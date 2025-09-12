<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        return response()->json($data, 200)
            ->withCookie(cookie('access_token', $data['access_token'], 60))
            ->withCookie(cookie('refresh_token', $data['refresh_token'], 43200));
    }

    public function refresh(Request $request): JsonResponse
    {
        $refresh_token = $request->cookie('refresh_token');

        $access_token = $this->authService->refresh($refresh_token);

        return response()->json([
            $access_token,
        ], 200)
            ->withCookie(cookie('access_token', $access_token['access_token'], 60));
    }

    public function user(): JsonResponse
    {
        $user = auth()->user();

        return response()->json([
            'user' => $user,
        ], 200);
    }
}
