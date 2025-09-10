<?php

namespace App\Services\Auth;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function __construct() {}

    public function register(RegisterDTO $registerDTO)
    {
        // $user = User::query()->where("email", $registerDTO->email)->first();

        return User::create([
            'first_name' => $registerDTO->first_name,
            'last_name' => $registerDTO->last_name,
            'middle_name' => $registerDTO->middle_name,
            'email' => $registerDTO->email,
            'phone' => $registerDTO->phone,
            'password' => Hash::make($registerDTO->password),
        ]);

    }

    public function logain(LoginDTO $loginDTO): array
    {
        if (! $token = JWTAuth::attempt(['email' => $loginDTO->email, 'password' => $loginDTO->password])) {
            throw new UnauthorizedException('Неверные данные');
        }

        $user = auth()->user();

        return ['token' => $token, 'user' => $user];
    }

    public function login(LoginDTO $loginDTO): array
    {
        // Генерируем access token через JWT
        if (! $accessToken = JWTAuth::attempt([
            'email' => $loginDTO->email,
            'password' => $loginDTO->password,
        ])) {
            throw new UnauthorizedException('Неверные данные');
        }

        $user = auth()->user();

        if (is_null($user->refresh_token_expires_at) || $user->refresh_token_expires_at <= now()) {
            $refreshToken = hash('sha256', Str::random(60));

            $user->refresh_token = $refreshToken;
            $user->refresh_token_expires_at = now()->addDays(7);
            $user->save();
        } else {
            $refreshToken = $user->refresh_token;
        }

        $accessCookie = Cookie::make('access_token', $accessToken, 60);
        $refreshCookie = Cookie::make('refresh_token', $refreshToken, 60 * 24 * 7);

        return [
            'user' => $user,
            'cookies' => [$accessCookie, $refreshCookie],
        ];
    }

    public function getUser()
    {
        $user = JWTAuth::parseToken()->authenticate();

        return $user;
    }

    public function refresh()
    {
        $refresh_token = JWTAuth::parseToken()->refresh();

        $user = JWTAuth::setToken($refresh_token)->toUser();

        return [
            'token' => $refresh_token,
            'user' => $user,
        ];
    }
}
