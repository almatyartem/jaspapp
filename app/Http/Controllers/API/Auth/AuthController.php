<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\AuthService;

abstract class AuthController extends BaseApiController
{
    public function __construct(
        protected readonly AuthService $authService
    ) {}

    protected function resource(User $model): UserResource
    {
        return UserResource::make($model);
    }

    protected function userData(User $user): UserResource
    {
        return $this->resource($user->load(['roles', 'spaces']));
    }
}
