<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "data" => [
                "id"          => $this->id,
                "name"        => $this->name,
                "description" => $this->description,
                "price"       => $this->price,
                "stock"       => $this->stock,
                "sku"         => $this->sku,
                "image_url"   => $this->image_url,
                "status"      => $this->status,
                'created_by'  => [
                    "id"   => $this->user->id,
                    "name" => $this->user->name,
                ],
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            ],
        ];
    }
}
