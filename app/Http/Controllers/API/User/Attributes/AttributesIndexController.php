<?php

namespace App\Http\Controllers\API\User\Attributes;

use App\Http\Requests\BaseIndexRequest;
use Illuminate\Http\JsonResponse;

class AttributesIndexController extends AttributesController
{
    public function __invoke(BaseIndexRequest $request) : JsonResponse
    {
        return $this->index($request);
    }
}
