<?php

namespace App\Http\Controllers\API\User\Attributes;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\TypeResource;
use App\Models\Attribute;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeDeleteController extends AttributesController
{
    public function __invoke(Attribute $model) : JsonResponse
    {
        return $this->boolResponse($this->repository->delete($model));
    }
}
