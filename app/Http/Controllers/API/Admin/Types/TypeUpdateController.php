<?php

namespace App\Http\Controllers\API\Admin\Types;

use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;

class TypeUpdateController extends TypesController
{
    public function __invoke(TypesRequest $request, Type $type) : TypeResource
    {
        return $this->resource($this->repository->update($type, $request->name, $request->base_type));
    }
}
