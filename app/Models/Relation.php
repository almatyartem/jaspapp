<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use RelationTypeEnum;

/**
 * 
 *
 * @property int $id;
 * @property string $name
 * @property string $relation_type
 * @property array $properties
 * @property string $created_at
 * @property string $updated_at
 * @property Collection $entities
 * @property-read int|null $entities_count
 * @method static Builder|Relation filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Relation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Relation newQuery()
 * @method static Builder|Relation paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Relation query()
 * @method static Builder|Relation simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Relation sort(array $sorting = [])
 * @method static Builder|Relation whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|Relation whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|Relation whereLike($column, $value, $boolean = 'and')
 * @mixin \Eloquent
 */
class Relation extends BaseModel
{
    protected $casts = [
        'properties' => 'array',
    ];

    public function entities() : BelongsToMany
    {
        return $this->belongsToMany(
            Entity::class,
            'relations_entities',
            'relation_id',
            'entity_id'
        )->withPivot('is_main');
    }

    protected function hasTypeMany(Entity $entity) : bool
    {
        //TODO $this->>pivot->is_main
        $isFirstEntity = false;
        return $this->relation_type === RelationTypeEnum::MANY_TO_MANY->name ||
            ($this->relation_type === RelationTypeEnum::ONE_TO_MANY && !$isFirstEntity);
    }
}
