<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id;
 * @property string $name
 * @property Project $project
 * @property boolean $is_draft
 * @property string $created_at
 * @property string $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attribute> $attributes
 * @property-read int|null $attributes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Relation> $relations
 * @property-read int|null $relations_count
 * @method static Builder|Entity filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entity newQuery()
 * @method static Builder|Entity paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Entity query()
 * @method static Builder|Entity simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Entity sort(array $sorting = [])
 * @method static Builder|Entity whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|Entity whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|Entity whereLike($column, $value, $boolean = 'and')
 * @mixin \Eloquent
 */
class Entity extends BaseModel
{
    public function project() : BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function attributes() : HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function relations() : BelongsToMany
    {
        return $this->belongsToMany(
            Relation::class,
            'relations_entities',
            'entity_id',
            'relation_id'
        )->withPivot('is_main');
    }
}
