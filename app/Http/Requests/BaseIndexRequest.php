<?php

namespace App\Http\Requests;

/**
 * @property int $per_page
 * @property array $sort
 * @property array $with
 * @property array $filters
 */
class BaseIndexRequest extends BaseApiRequest
{
    public function rules(): array
    {
        return [
            'per_page' => 'integer|sometimes',
            'sort' => 'array|nullable',
            'sort.field' => 'string|required_with:sort',
            'sort.type' => 'string|required_with:sort|in:ASC,DESC',
            'filters' => 'array|nullable',
            'with' => 'array|nullable'
        ];
    }
}
