<?php

namespace App\Http\Requests\Relations;

use App\Http\Requests\BaseApiRequest;
use App\Models\Entity;
use Illuminate\Validation\Rule;
use RelationTypeEnum;

/**
 * @property RelationTypeEnum $relation_type
 * @property string $name
 */
class RelationsUpdateRequest extends RelationsRequest
{
    protected function usedRulesKeys() : array
    {
        return ['relation_type', 'name'];
    }
}
