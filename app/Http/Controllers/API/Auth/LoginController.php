<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;


class LoginController extends AuthController
{
    public function __invoke(LoginRequest $request)
    {
        $user = $this->authService->login(
            email: Str::lower($request->input('email')),
            password: $request->input('password'),
        );

        if(!$user){
            abort(Response::HTTP_UNAUTHORIZED);
        }

        return $this->userData($user);
    }
}
