<?php

namespace App\Http\Controllers\API\User\Relations;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Controllers\API\User\Attributes\AttributesController;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\RelationResource;
use App\Http\Resources\TypeResource;
use App\Models\Attribute;
use App\Models\Relation;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class RelationShowController extends RelationsController
{
    public function __invoke(Relation $model) : RelationResource
    {
        return $this->resource($model);
    }
}
