<?php

namespace App\Http\Controllers\API\Admin\Types;

use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;

class TypeShowController extends TypesController
{
    public function __invoke(Type $type) : TypeResource
    {
        return $this->resource($type);
    }
}
