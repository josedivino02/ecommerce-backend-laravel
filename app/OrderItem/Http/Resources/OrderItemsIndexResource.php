<?php

namespace App\OrderItem\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsIndexResource extends JsonResource
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
        ];
    }
}
