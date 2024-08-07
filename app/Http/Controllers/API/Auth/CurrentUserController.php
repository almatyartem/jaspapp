<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;


class CurrentUserController extends AuthController
{
    public function __invoke()
    {
        $user = auth()->user();
        if(!$user){
            abort(Response::HTTP_UNAUTHORIZED);
        }

        return $this->userData($user);
    }
}
