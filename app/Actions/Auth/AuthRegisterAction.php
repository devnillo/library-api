<?php

namespace App\Actions\Auth;

use App\Models\User;

class AuthRegisterAction
{
    public function handle(array $credentials): string
    {
        $user = User::create($credentials);
        return $user->createToken("auth_token")->plainTextToken;
    }
}
