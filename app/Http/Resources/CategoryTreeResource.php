<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_id' => $this->parent?->id??null,
            'children' => CategoryTreeResource::collection($this->whenLoaded('childrenRecursive')),
            'providers' => ProviderResource::collection($this->whenLoaded('providers')),
        ];
    }
}
