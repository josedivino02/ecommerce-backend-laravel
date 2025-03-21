<?php

namespace App\OrderItem\Http\Resources;

use App\OrderItem\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read OrderItem $resource
 */
class OrderItemsIndexResource extends JsonResource
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
            "product_id"  => $this->resource->product_id,
            "tracking"    => $this->resource->tracking,
            "price"       => $this->resource->unit_price,
            "quantity"    => $this->resource->quantity,
            "total_price" => $this->resource->total_price,
            "status"      => $this->resource->status,
        ];
    }
}
