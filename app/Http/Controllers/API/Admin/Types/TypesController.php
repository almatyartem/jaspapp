<?php

namespace App\Http\Controllers\API\Admin\Types;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use App\Services\Repositories\TypesRepository;

abstract class TypesController extends BaseApiController
{
    public function __construct(
        protected readonly TypesRepository $repository,
        protected readonly TypeResource $resource
    ){}

    protected function resource(Type $model) : TypeResource
    {
        return $this->resource->make($model);
    }
}
