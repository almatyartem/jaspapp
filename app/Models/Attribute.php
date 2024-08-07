<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id;
 * @property string $name;
 * @property Entity $entity;
 * @property Type $type;
 * @property array $properties
 * @property string $created_at
 * @property string $updated_at
 * @method static Builder|Attribute filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute newQuery()
 * @method static Builder|Attribute paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Attribute query()
 * @method static Builder|Attribute simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Attribute sort(array $sorting = [])
 * @method static Builder|Attribute whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|Attribute whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|Attribute whereLike($column, $value, $boolean = 'and')
 * @mixin \Eloquent
 */
class Attribute extends BaseModel
{
    protected $casts = [
        'properties' => 'array',
    ];

    public function entity() : BelongsTo
    {
        return $this->belongsTo(Entity::class);
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
