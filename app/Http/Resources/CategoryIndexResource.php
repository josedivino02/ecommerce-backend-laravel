<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "data" => [
                "uuid"           => $this->uuid,
                "name"           => $this->name,
                "slug"           => $this->slug,
                "sub"            => $this->sub,
                "description"    => $this->description,
                "sub_categories" => CategoryIndexResource::collection($this->whenLoaded('subCategories')),
                "created_at"     => $this->created_at->format("Y-m-d H:i:s"),
                "updated_at"     => $this->updated_at->format("Y-m-d H:i:s"),
            ],
        ];
    }
}
