<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $guarded = [];

    use Filterable;

    public function scopeSort(
        Builder $query,
        array $sorting = ['field' => 'id', 'type' => 'ASC']
    ): Builder {
        return $query->when($sorting, function (Builder $q) use ($sorting) {
            return $q->orderBy($sorting['field'], $sorting['type']);
        });
    }
}
