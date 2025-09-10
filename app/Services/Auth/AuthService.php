<?php

namespace App\Services\Auth;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Models\User;
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

    public function login(LoginDTO $loginDTO): array
    {
        if (! $accessToken = JWTAuth::attempt(['email' => $loginDTO->email, 'password' => $loginDTO->password])) {
            throw new UnauthorizedException('Неверные данные');
        }

        $user = auth()->user();

        $refreshToken = hash('sha256', Str::random(60));
        $user->update([
            'refresh_token' => $refreshToken,
            'refresh_token_expires_at' => now()->addDays(7),
        ]);

        return [
            'access_token' => $accessToken,
            'refresh_token' => $refreshToken,
            'user' => $user,
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
