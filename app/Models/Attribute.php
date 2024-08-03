<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id;
 * @property string $name;
 * @property Entity $entity;
 * @property Type $type;
 * @property array $properties
 * @property string $created_at
 * @property string $updated_at
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
