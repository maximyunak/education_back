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

    public function register(RegisterDTO $registerDTO): User
    {

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
        if (! $access_token = JWTAuth::attempt(['email' => $loginDTO->email, 'password' => $loginDTO->password])) {
            throw new UnauthorizedException('Неверные данные');
        }

        $user = auth()->user();

        $refresh_token = hash('sha256', Str::random(60));
        $user->update([
            'refresh_token' => $refresh_token,
            'refresh_token_expires_at' => now()->addDays(7),
        ]);

        return [
            'access_token' => $access_token,
            'refresh_token' => $refresh_token,
            'user' => $user,
        ];
    }

    public function refresh($refresh_token): array
    {
        $user = User::where('refresh_token', $refresh_token)
            ->where('refresh_token_expires_at', '>', now())
            ->first();

        if (! $user) {
            throw new UnauthorizedException('Refresh токен не действителен');
        }

        $access_token = JWTAuth::fromUser($user);

        return [
            'access_token' => $access_token,
        ];
    }
}
