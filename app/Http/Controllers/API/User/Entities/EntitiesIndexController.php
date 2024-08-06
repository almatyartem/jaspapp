<?php

namespace App\Http\Controllers\API\User\Entities;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\BaseIndexRequest;
use Illuminate\Http\JsonResponse;


class EntitiesIndexController extends EntitiesController
{
    public function __invoke(BaseIndexRequest $request) : JsonResponse
    {
        return $this->index($request);
    }
}
