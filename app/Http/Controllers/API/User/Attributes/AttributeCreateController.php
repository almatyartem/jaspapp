<?php

namespace App\Http\Controllers\API\User\Attributes;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Attributes\AttributesRequest;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\TypeResource;
use App\Models\Entity;
use App\Models\Type;

class AttributeCreateController extends AttributesController
{
    public function __invoke(AttributesRequest $request, Entity $entity) : AttributeResource
    {
        return $this->resource($this->repository->create(
            $entity,
            Type::findOrFail($request->type),
            $request->name
        ));
    }
}
