<?php

namespace App\Http\Controllers\API\User\Relations;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Relations\RelationsRequest;
use App\Http\Requests\Relations\RelationsUpdateRequest;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\RelationResource;
use App\Http\Resources\TypeResource;
use App\Models\Entity;
use App\Models\Relation;

class RelationUpdateController extends RelationsController
{
    public function __invoke(RelationsUpdateRequest $request, Relation $relation) : RelationResource
    {
        return $this->resource($this->repository->update(
            $relation,
            $request->relation_type,
            $request->name
        ));
    }
}
