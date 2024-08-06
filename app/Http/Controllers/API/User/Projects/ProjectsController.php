<?php

namespace App\Http\Controllers\API\User\Projects;

use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\Repositories\ProjectsRepository;

abstract class ProjectsController extends BaseApiController
{
    public function __construct(
        protected readonly ProjectsRepository $repository,
        protected readonly ProjectResource $resource
    ){}

    protected function resource(Project $model) : ProjectResource
    {
        return $this->resource->make($model);
    }
}
