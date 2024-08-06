<?php

namespace App\Http\Controllers\API\Admin\Types;

use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeDeleteController extends TypesController
{
    public function __invoke(Type $model) : JsonResponse
    {
        return $this->boolResponse($this->repository->delete($model));
    }
}
