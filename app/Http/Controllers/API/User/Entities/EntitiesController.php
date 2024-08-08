<?php

namespace App\Http\Controllers\API\User\Entities;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\EntityResource;
use App\Models\Entity;
use App\Services\Repositories\EntitiesRepository;

abstract class EntitiesController extends BaseApiController
{
    public function __construct(
        protected readonly EntitiesRepository $repository,
    ) {}

    protected function resource(Entity $model): EntityResource
    {
        return EntityResource::make($model);
    }
}
