<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id;
 * @property string $name
 * @property string $base_type
 * @property string $created_at
 * @property string $updated_at
 */
class Type extends BaseModel
{
    public function attributes() : HasMany
    {
        return $this->hasMany(Attribute::class);
    }
}
