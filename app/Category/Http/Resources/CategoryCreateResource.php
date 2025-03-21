<?php

namespace App\Category\Http\Resources;

use App\Category\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Category $resource
 */
class CategoryCreateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "uuid"        => $this->resource->uuid,
            "name"        => $this->resource->name,
            "slug"        => $this->resource->slug,
            "sub"         => $this->resource->sub,
            "description" => $this->resource->description,
            "created_at"  => $this->resource->created_at->format("Y-m-d H:i:s"),
            "updated_at"  => $this->resource->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
