<?php

namespace App\Http\Resources;

use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Entity $resource
 */
class EntityResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'is_draft' => $this->resource->is_draft,
        ];
    }
}
