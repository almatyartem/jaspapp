<?php

namespace App\Http\Resources;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Type $resource
 */
class TypeResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'base_type' => $this->resource->base_type,
        ];
    }
}
