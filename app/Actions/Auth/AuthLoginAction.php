<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\AuthLoginDTO;
use Illuminate\Support\Facades\Auth;

class AuthLoginAction
{
    public function handle(AuthLoginDTO $credentials)
    {
        if (!Auth::attempt($credentials->toArray())) {
            return false;
        }
        $user = Auth::user();
        $user->tokens()->delete();
        return $user->createToken("auth_token")->plainTextToken;
    }
}
