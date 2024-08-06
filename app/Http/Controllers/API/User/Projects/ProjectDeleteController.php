<?php

namespace App\Http\Controllers\API\User\Projects;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\TypeResource;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectDeleteController extends ProjectsController
{
    public function __invoke(Project $model) : JsonResponse
    {
        return $this->boolResponse($this->repository->delete($model));
    }
}
