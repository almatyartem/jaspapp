<?php

namespace App\Http\Controllers\API\User\Relations;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\RelationResource;
use App\Models\Relation;
use App\Services\Repositories\RelationsRepository;

abstract class RelationsController extends BaseApiController
{
    public function __construct(
        protected readonly RelationsRepository $repository
    ) {}

    protected function resource(Relation $model): RelationResource
    {
        return RelationResource::make($model);
    }
}
