<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\TypeResource;
use App\Http\Resources\UserResource;
use App\Models\Type;
use App\Models\User;
use App\Services\AuthService;
use App\Services\Repositories\TypesRepository;

abstract class AuthController extends BaseApiController
{
    public function __construct(
        protected readonly AuthService $authService,
        protected readonly UserResource $resource
    ){}

    protected function resource(User $model) : UserResource
    {
        return $this->resource->make($model);
    }

    protected function userData(User $user) : UserResource
    {
        return $this->resource($user->load(['roles', 'spaces']));
    }
}
