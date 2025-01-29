<?php

namespace App\Http\Resources\OrderItem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsCreateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "uuid"        => $this->uuid,
            "product_id"  => $this->product_id,
            "tracking"    => $this->tracking,
            "price"       => $this->unit_price,
            "quantity"    => $this->quantity,
            "total_price" => $this->total_price,
            "status"      => $this->status,
            "created_at"  => $this->created_at->format("Y-m-d H:i:s"),
            "updated_at"  => $this->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
