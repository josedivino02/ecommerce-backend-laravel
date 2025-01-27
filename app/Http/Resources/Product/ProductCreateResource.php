<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCreateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "data" => [
                "uuid"        => $this->uuid,
                "name"        => $this->name,
                "description" => $this->description,
                "price"       => $this->price,
                "stock"       => $this->stock,
                "sku"         => $this->sku,
                "image_url"   => $this->image_url,
                "status"      => $this->status,
                "category_id" => $this->category->name,
                "created_by"  => [
                    "uuid"  => $this->user->uuid,
                    "email" => $this->user->email,
                    "name"  => $this->user->name,
                ],
                "created_at" => $this->created_at->format("Y-m-d H:i:s"),
                "updated_at" => $this->updated_at->format("Y-m-d H:i:s"),
            ],
        ];
    }
}