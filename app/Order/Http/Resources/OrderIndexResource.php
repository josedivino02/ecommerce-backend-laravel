<?php

namespace App\Order\Http\Resources;

use App\OrderItem\Http\Resources\OrderItemsIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Request;

class OrderIndexResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "uuid"              => $this->uuid,
            "payment_method"    => $this->payment_method,
            "payment_status"    => $this->payment_status,
            "shipping_method"   => $this->shipping_method,
            "shipping_status"   => $this->shipping_status,
            "shipping_address"  => $this->shipping_address,
            "billing_address"   => $this->billing_address,
            "discount"          => $this->discount,
            "total_price"       => $this->total_price,
            "verification_code" => $this->verification_code,
            "status"            => $this->status,
            "items"             => OrderItemsIndexResource::collection($this->whenLoaded("orderItems")),
        ];
    }
}
