<?php

namespace App\Http\Controllers\API\User\Entities;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\TypeResource;
use App\Models\Entity;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityDeleteController extends EntitiesController
{
    public function __invoke(Entity $model) : JsonResponse
    {
        return $this->boolResponse($this->repository->delete($model));
    }
}
