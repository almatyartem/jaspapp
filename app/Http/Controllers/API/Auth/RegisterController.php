<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends AuthController
{
    public function __invoke(RegisterRequest $request)
    {
        $user = $this->authService->register(
            $request->input('name'),
            $request->input('email'),
            $request->input('password')
        );

        return $this->userData($user);
    }
}
