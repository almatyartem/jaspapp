<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use RelationTypeEnum;

/**
 * @property int $id;
 * @property string $name
 * @property string $relation_type
 * @property array $properties
 * @property string $created_at
 * @property string $updated_at
 * @property Collection $entities
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
        //TODO
        $isFirstEntity = false;
        return $this->relation_type === RelationTypeEnum::MANY_TO_MANY->name ||
            ($this->relation_type === RelationTypeEnum::ONE_TO_MANY && !$isFirstEntity);
    }
}
