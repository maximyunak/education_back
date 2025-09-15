<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ChangeRoleRequest;
use App\Models\User;
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

    public function users()
    {
        return User::all();
    }

    public function changeRole(User $user, ChangeRoleRequest $request)
    {
        $role_id = $request->validated('role_id');

        $user = $this->userService->changeRole($user, $role_id);

        return $user;
    }
}
