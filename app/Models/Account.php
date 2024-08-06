<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends BaseModel
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'accounts_users',
            'account_id',
            'user_id'
        );
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
