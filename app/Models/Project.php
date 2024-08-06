<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id;
 * @property string $name
 * @property User $user
 * @property string $created_at
 * @property string $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Entity> $entities
 * @property-read int|null $entities_count
 * @method static Builder|Project filter(array $input = [], $filter = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static Builder|Project paginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static Builder|Project simplePaginateFilter($perPage = null, $columns = [], $pageName = 'page', $page = null)
 * @method static Builder|Project sort(array $sorting = [])
 * @method static Builder|Project whereBeginsWith($column, $value, $boolean = 'and')
 * @method static Builder|Project whereEndsWith($column, $value, $boolean = 'and')
 * @method static Builder|Project whereLike($column, $value, $boolean = 'and')
 * @mixin \Eloquent
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
