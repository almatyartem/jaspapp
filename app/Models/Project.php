<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id;
 * @property string $name
 * @property User $user
 * @property string $created_at
 * @property string $updated_at
 */
class Project extends BaseModel
{
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function entities() : HasMany
    {
        return $this->hasMany(Entity::class);
    }
}
