<?php

namespace App\Http\Controllers\API\User\Attributes;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use App\Services\Repositories\AttributesRepository;

abstract class AttributesController extends BaseApiController
{
    public function __construct(
        protected readonly AttributesRepository $repository,
        protected readonly AttributeResource $resource
    ){}

    protected function resource(Attribute $model) : AttributeResource
    {
        return $this->resource->make($model);
    }
}
