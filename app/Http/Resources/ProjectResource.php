<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Project $resource
 */
class ProjectResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'account' => $this->whenLoaded('account', function () {
                return AccountResource::make($this->resource->user);
            })
        ];
    }
}
