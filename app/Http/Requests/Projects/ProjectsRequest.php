<?php

namespace App\Http\Requests\Projects;

use App\Http\Requests\BaseApiRequest;
use App\Http\Requests\BaseChangingRequest;

/**
 * @property string $name
 */
class ProjectsRequest extends BaseChangingRequest
{
    public function allRules(): array
    {
        return [
            'name' => ['required', 'string']
        ];
    }
}
