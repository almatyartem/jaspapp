<?php

namespace App\Http\Controllers\API\User\Projects;

use App\Http\Controllers\API\Admin\Types\TypesController;
use App\Http\Controllers\API\User\Attributes\AttributesController;
use App\Http\Requests\Types\TypesRequest;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\TypeResource;
use App\Models\Attribute;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectShowController extends ProjectsController
{
    public function __invoke(Project $model) : ProjectResource
    {
        return $this->resource($model);
    }
}
