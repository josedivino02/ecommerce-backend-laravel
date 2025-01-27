<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "uuid"           => $this->uuid,
            "name"           => $this->name,
            "slug"           => $this->slug,
            "sub"            => $this->sub,
            "description"    => $this->description,
            "status"         => $this->status,
            "sub_categories" => CategoryIndexResource::collection($this->whenLoaded('subCategories')),
        ];
    }
}