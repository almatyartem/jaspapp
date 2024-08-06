<?php

namespace App\Http\Controllers\API\User\Projects;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Projects\ProjectsRequest;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TypeResource;

class ProjectCreateController extends ProjectsController
{
    public function __invoke(ProjectsRequest $request) : ProjectResource
    {
        return $this->resource($this->repository->create($request->user(), $request->name));
    }
}
