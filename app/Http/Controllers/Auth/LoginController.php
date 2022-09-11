<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Resources\UsuarioResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends ApiController
{
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = auth()->user();
            return $this->successResponse(UsuarioResource::mapUsuarioLogado($user, $user->createToken('LaravelSanctumAuth')->plainTextToken), 'Logado com sucesso!', 201);
        }
        return $this->errorResponse([], 401, 'Falha ao tentar Logar!');
    }

    public function logout()
    {
        auth()->logout();
        return response(null, 200);
    }
}
