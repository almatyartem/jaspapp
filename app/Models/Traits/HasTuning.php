<?php

namespace App\Models\Traits;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;

trait HasTuning {
    use Filterable;

    public function scopeSort(
        Builder $query,
        array $sorting = ['field' => 'id', 'type' => 'ASC']
    ): Builder {
        return $query->when($sorting, function (Builder $q) use ($sorting) {
            return $q->orderBy($sorting['field'], $sorting['type']);
        });
    }
    public function sort(array $sorting = [])
    {
        return $this->callNamedScope('sort', ['sorting' => $sorting]);
    }

    public function filter(array $filters = [])
    {
        return $this->callNamedScope('filter', ['filters' => $filters]);
    }

    abstract public function callNamedScope($scope, array $parameters = []);
}
