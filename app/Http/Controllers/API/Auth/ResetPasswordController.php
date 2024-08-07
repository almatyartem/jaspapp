<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\JsonResponse;


class ResetPasswordController extends AuthController
{
    public function __invoke(ResetPasswordRequest $request): JsonResponse
    {
        return $this->boolResponse($this->authService->resetPassword(
            email: $request->get('email'),
            token: $request->get('token'),
            password: $request->get('password'),
        ));
    }
}
