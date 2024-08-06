<?php

namespace App\Http\Requests\Types;

use App\Http\Requests\BaseApiRequest;
use App\Http\Requests\BaseChangingRequest;

/**
 * @property string $name
 * @property string $base_type
 */
class TypesRequest extends BaseChangingRequest
{
    public function allRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'base_type' => ['required', 'string']
        ];
    }
}
