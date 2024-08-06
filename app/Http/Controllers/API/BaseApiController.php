<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseIndexRequest;
use App\Http\Resources\BaseResource;
use App\Models\BaseModel;
use App\Services\Repositories\BaseRepository;
use Illuminate\Http\JsonResponse;

/**
 * @property BaseRepository $repository;
 * @property BaseResource $resource;
 */
abstract class BaseApiController extends Controller
{
    protected function delete(BaseModel $model) : JsonResponse
    {
        return $this->boolResponse($this->repository->delete($model));
    }

    protected function index(BaseIndexRequest $request)
    {
        $data = $this->repository->getPaginatedList(
            $request->per_page,
            $request->with,
            $request->sort,
            $request->filters
        );

        return response()->json( [
            'data' => $this->resource->collection($data->items()),
            'meta' => $this->resource->make($data),
        ]);
    }

    protected function boolResponse(bool $isSucceed) : JsonResponse
    {
        return response()->json(['success' => $isSucceed], $isSucceed ? 200 : 400);
    }
}
