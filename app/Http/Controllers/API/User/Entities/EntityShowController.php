<?php

namespace App\Http\Controllers\API\User\Entities;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Controllers\API\User\Attributes\AttributesController;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\EntityResource;
use App\Http\Resources\TypeResource;
use App\Models\Attribute;
use App\Models\Entity;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityShowController extends EntitiesController
{
    public function __invoke(Entity $model) : EntityResource
    {
        return $this->resource($model);
    }
}
