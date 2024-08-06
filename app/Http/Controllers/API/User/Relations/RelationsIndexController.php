<?php

namespace App\Http\Controllers\API\User\Relations;

use App\Http\Requests\BaseIndexRequest;
use Illuminate\Http\JsonResponse;

class RelationsIndexController extends RelationsController
{
    public function __invoke(BaseIndexRequest $request) : JsonResponse
    {
        return $this->index($request);
    }
}
