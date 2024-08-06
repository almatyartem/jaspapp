<?php

namespace App\Http\Requests\Relations;

use App\Http\Requests\BaseApiRequest;
use App\Http\Requests\BaseChangingRequest;
use App\Models\Entity;
use Illuminate\Validation\Rule;
use RelationTypeEnum;

/**
 * @property string $first_entity
 * @property string $second_entity
 * @property RelationTypeEnum $relation_type
 * @property string $name
 */
class RelationsRequest extends BaseChangingRequest
{
    public function allRules(): array
    {
        return [
            'first_entity' => ['required', 'integer', 'exists:'.$this->tableName(Entity::class).',id'],
            'second_entity' => ['required', 'integer', 'exists:'.$this->tableName(Entity::class).',id'],
            'relation_type' => [Rule::enum(RelationTypeEnum::class)],
            'name' => ['sometimes', 'nullable', 'string'],

        ];
    }
}
