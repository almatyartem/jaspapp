<?php

namespace App\Services\Repositories;

use App\Models\Attribute;
use App\Models\BaseModel;
use App\Models\Entity;
use App\Models\Type;
use Illuminate\Pagination\LengthAwarePaginator;

abstract readonly class BaseRepository
{
    abstract protected function getModel(): BaseModel;

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

    public function delete(BaseModel $record) : bool
    {
        return $record->delete();
    }
}
