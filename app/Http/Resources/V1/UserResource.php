<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\DateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => [
                'adress' => $this->resource->email,
                'verified' => $this->resource->hasVerifiedEmail()
            ],
            'created_at' => new DateResource($this->resource->created_at),
            'updated_at' => new DateResource($this->resource->updated_at)
        ];
    }
}
