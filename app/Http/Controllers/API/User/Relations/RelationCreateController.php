<?php

namespace App\Http\Controllers\API\User\Relations;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Relations\RelationsRequest;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\RelationResource;
use App\Http\Resources\TypeResource;
use App\Models\Entity;

class RelationCreateController extends RelationsController
{
    public function __invoke(RelationsRequest $request) : RelationResource
    {
        return $this->resource($this->repository->create(
            Entity::findOrFail($request->first_entity),
            Entity::findOrFail($request->second_entity),
            $request->relation_type,
            $request->name
        ));
    }
}
