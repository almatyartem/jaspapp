<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id;
 * @property string $name
 * @property string $base_type
 * @property string $created_at
 * @property string $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attribute> $attributes
 * @property-read int|null $attributes_count
 * @method static Builder|Type filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Type newQuery()
 * @method static Builder|Type paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Type query()
 * @method static Builder|Type simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Type sort(array $sorting = [])
 * @method static Builder|Type whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|Type whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|Type whereLike($column, $value, $boolean = 'and')
 * @method static Builder|Type findOrFail($id)
 * @mixin \Eloquent
 */
class Type extends BaseModel
{
    public function attributes() : HasMany
    {
        return $this->hasMany(Attribute::class);
    }
}
