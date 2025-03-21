<?php

namespace App\Product\Http\Resources;

use App\Category\Http\Resources\CategoryIndexResource;

use App\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Product $resource
 */
class ProductIndexResource extends JsonResource
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
            "price"       => $this->resource->price,
            "stock"       => $this->resource->stock,
            "sku"         => $this->resource->sku,
            "image_url"   => $this->resource->image_url,
            "description" => $this->resource->description,
            "category"    => CategoryIndexResource::make($this->whenLoaded("category")),
        ];
    }
}
