<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends AuthController
{
    public function __invoke(Request $request): JsonResponse
    {
        return $this->boolResponse($this->authService->logout($request->user()));
    }
}
