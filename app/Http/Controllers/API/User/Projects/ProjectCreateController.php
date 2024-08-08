<?php

namespace App\Http\Controllers\API\User\Projects;

use App\Http\Requests\Projects\ProjectsRequest;
use App\Http\Resources\ProjectResource;

class ProjectCreateController extends ProjectsController
{
    public function __invoke(ProjectsRequest $request): ProjectResource
    {
        return $this->resource($this->repository->create($request->user(), $request->name));
    }
}
