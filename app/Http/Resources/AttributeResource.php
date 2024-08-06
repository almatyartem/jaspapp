<?php

namespace App\Http\Resources;

use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Attribute $resource
 */
class AttributeResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'type' => $this->whenLoaded('type', function () {
                return TypeResource::make($this->resource->type);
            })
        ];
    }
}
