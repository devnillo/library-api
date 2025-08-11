<?php

namespace App\Http\Controllers;

use App\Actions\Auth\AuthLoginAction;
use App\Actions\Auth\AuthRegisterAction;
use App\DTOs\Auth\AuthLoginDTO;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\AuthUserResource;
use App\Http\Responses\JsonApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Post;
use Spatie\RouteAttributes\Attributes\Prefix;

#[Prefix("auth")]
class AuthController extends Controller
{
    #[Post("register")]
    public function register(
        RegisterUserRequest $request,
        AuthRegisterAction $action,
    ) {
        $credentials = $request->validated();
        $token = $action->handle($credentials);
        return JsonApiResponse::success($token, "Usuario logado com sucesso");

    }

    #[Post("login")]
    public function login(LoginUserRequest $request, AuthLoginAction $action)
    {
        $credentials = $request->all();
        $token = $action->handle(AuthLoginDTO::fromArray($credentials));
        if (!$token) {
            return JsonApiResponse::error("Credenciais invalidas", 401);
        }
        return JsonApiResponse::success($token, "Login realizado com sucesso");
    }

    #[Get("user", middleware: "auth:sanctum")]
    public function getUser(Request $request)
    {
        $user = Auth::user();
        return JsonApiResponse::success(
            AuthUserResource::make($user),
            "Usuário autenticado com sucesso",
        );
    }
}
