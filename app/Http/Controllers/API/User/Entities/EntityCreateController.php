<?php

namespace App\Http\Controllers\API\User\Entities;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Entities\EntitiesRequest;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\EntityResource;
use App\Http\Resources\TypeResource;
use App\Models\Project;

class EntityCreateController extends EntitiesController
{
    public function __invoke(EntitiesRequest $request, Project $project) : EntityResource
    {
        return $this->resource($this->repository->create($project, $request->name, $request->is_draft));
    }
}
