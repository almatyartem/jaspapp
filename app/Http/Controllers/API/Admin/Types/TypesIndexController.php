<?php

namespace App\Http\Controllers\API\Admin\Types;

use App\Http\Requests\BaseIndexRequest;
use Illuminate\Http\JsonResponse;


class TypesIndexController extends TypesController
{
    public function __invoke(BaseIndexRequest $request) : JsonResponse
    {
        return $this->index($request);
    }
}
