<?php

namespace App\Models;

use App\Models\Base\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Space extends BaseModel
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'spaces_users',
            'space_id',
            'user_id'
        )->withPivot(['is_owner']);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
