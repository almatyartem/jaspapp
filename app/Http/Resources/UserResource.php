<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property User $resource
 */
class UserResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
        ];

        if($token = $this->resource->getAccessToken()){
            $data['token'] = $token;
        }

        return $data;
    }
}
