<?php

namespace App\Http\Controllers\API\User\Projects;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\BaseIndexRequest;
use Illuminate\Http\JsonResponse;


class ProjectsIndexController extends ProjectsController
{
    public function __invoke(BaseIndexRequest $request) : JsonResponse
    {
        return $this->index($request);
    }
}
