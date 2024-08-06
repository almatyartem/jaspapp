<?php

namespace App\Http\Requests\Attributes;

use App\Http\Requests\BaseApiRequest;
use App\Http\Requests\BaseChangingRequest;
use App\Models\Type;

/**
 * @property string $name
 * @property integer $type
 */
class AttributesRequest extends BaseChangingRequest
{
    public function allRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'type' => ['required', 'integer', 'exists:'.$this->tableName(Type::class).',id'],
        ];
    }
}
