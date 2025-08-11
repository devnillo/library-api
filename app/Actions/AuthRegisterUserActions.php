<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\AuthUserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;


class AuthRegisterUserActions extends Controller
{
    public static function handle($request): array
    {
        $credentials = $request->validated();
        $user = User::create($credentials);

        $token = $user->createToken('auth_token')->plainTextToken;
        return $token;
    }    
}
