<?php

namespace App\Services\User;

use App\Models\User;

class UserService
{
    public function __construct() {}

    public function changeRole(User $user, int $role_id)
    {
        $user->update(['role_id' => $role_id]);

        return $user;
    }
}
