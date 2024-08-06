<?php

namespace App\Http\Resources;

use App\Models\Relation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Relation $resource
 */
class RelationResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'relation_type' => $this->resource->relation_type,
            'entities' => $this->whenLoaded('entities', function () {
                return EntityResource::collection($this->resource->entities);
            })
        ];
    }
}
