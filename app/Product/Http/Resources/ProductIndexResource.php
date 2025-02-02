<?php

namespace App\Product\Http\Resources;

use App\Category\Http\Resources\CategoryIndexResource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "uuid"        => $this->uuid,
            "name"        => $this->name,
            "price"       => $this->price,
            "stock"       => $this->stock,
            "sku"         => $this->sku,
            "image_url"   => $this->image_url,
            "description" => $this->description,
            "category"    => CategoryIndexResource::make($this->whenLoaded("category")),
        ];
    }
}