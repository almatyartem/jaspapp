<?php

namespace App\Http\Requests\Entities;

use App\Http\Requests\BaseApiRequest;
use App\Http\Requests\BaseChangingRequest;

/**
 * @property string $name
 * @property boolean $is_draft
 */
class EntitiesRequest extends BaseChangingRequest
{
    public function allRules(): array
    {
        return [
            'name' => ['required', 'string'],
            'is_draft' => ['sometimes', 'boolean']
        ];
    }
}
