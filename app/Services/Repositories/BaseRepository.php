<?php

namespace App\Services\Repositories;

use App\Models\Base\BaseModel;
use App\Models\Interfaces\TunedModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract readonly class BaseRepository
{
    abstract protected function getModel(): TunedModel;

    public function getPaginatedList(
        int $perPage,
        array $with = [],
        array $sorting = [],
        array $filters = [],
    ): LengthAwarePaginator {
        return $this->getModel()::query()
            ->with($with)
            ->sort($sorting)
            ->filter($filters)
            ->paginate($perPage);
    }

    public function delete(Model $record) : bool
    {
        return $record->delete();
    }
}
