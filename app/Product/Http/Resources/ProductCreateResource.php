<?php

namespace App\Product\Http\Resources;

use App\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Product $resource
 */
class ProductCreateResource extends JsonResource
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
            "description" => $this->resource->description,
            "price"       => $this->resource->price,
            "stock"       => $this->resource->stock,
            "sku"         => $this->resource->sku,
            "image_url"   => $this->resource->image_url,
            "status"      => $this->resource->status,
            "category_id" => $this->resource->category->name,
            "created_by"  => [
                "uuid"  => $this->resource->user->uuid,
                "email" => $this->resource->user->email,
                "name"  => $this->resource->user->name,
            ],
            "created_at" => $this->resource->created_at->format("Y-m-d H:i:s"),
            "updated_at" => $this->resource->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
