<?php

namespace App\Http\Controllers\API\Admin\Types;

use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\TypeResource;

class TypeCreateController extends TypesController
{
    public function __invoke(TypesRequest $request) : TypeResource
    {
        return $this->resource($this->repository->create($request->name, $request->base_type));
    }
}
