<?php

namespace App\Http\Controllers\API\User\Relations;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\TypeResource;
use App\Models\Relation;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class RelationDeleteController extends RelationsController
{
    public function __invoke(Relation $model) : JsonResponse
    {
        return $this->boolResponse($this->repository->delete($model));
    }
}
