<?php

namespace App\Http\Controllers\API\User\Projects;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Projects\ProjectsRequest;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TypeResource;
use App\Models\Project;

class ProjectUpdateController extends ProjectsController
{
    public function __invoke(ProjectsRequest $request, Project $project) : ProjectResource
    {
        return $this->resource($this->repository->update($project, $request->name));
    }
}
