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

#[Prefix('auth')]
class AuthController extends Controller
{
    #[Post('register')]
    public function register(RegisterUserRequest $request)
    {
        $credentials = $request->validated();

        $user = User::create($credentials);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'error' => false,
            'message' => 'Usuario Registrado com sucesso',
            'data' => $token
        ]);
    }
    #[Post('login')]
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'error' => true,
                'message' => 'Credentiais invalidas',
                'data' => ""
            ], 400);
        }

        $user = Auth::user();
        $user->tokens()->delete();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'error' => false,
            'message' => 'Usuario Registrado com sucesso',
            'data' => $token
        ]);
    }
    #[Get('user', middleware:'auth:sanctum')]
    public function getUser(Request $request)
    {
        $user = Auth::user();
        return response()->json([
                'error' => false,
                'message' => 'sucesso',
                'data' => AuthUserResource::make($user)
            ], 200);
    }
    
}
