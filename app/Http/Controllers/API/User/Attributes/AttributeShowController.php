<?php

namespace App\Http\Controllers\API\User\Attributes;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\TypeResource;
use App\Models\Attribute;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeShowController extends AttributesController
{
    public function __invoke(Attribute $model) : AttributeResource
    {
        return $this->resource($model);
    }
}
