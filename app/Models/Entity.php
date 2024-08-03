<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id;
 * @property string $name
 * @property Project $project
 * @property boolean $is_draft
 * @property string $created_at
 * @property string $updated_at
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
