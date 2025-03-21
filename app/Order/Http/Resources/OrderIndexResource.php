<?php

namespace App\Order\Http\Resources;

use App\Order\Models\Order;
use App\OrderItem\Http\Resources\OrderItemsIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Request;

/**
 * @property-read Order $resource
 */
class OrderIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "uuid"              => $this->resource->uuid,
            "payment_method"    => $this->resource->payment_method,
            "payment_status"    => $this->resource->payment_status,
            "shipping_method"   => $this->resource->shipping_method,
            "shipping_status"   => $this->resource->shipping_status,
            "shipping_address"  => $this->resource->shipping_address,
            "billing_address"   => $this->resource->billing_address,
            "discount"          => $this->resource->discount,
            "total_price"       => $this->resource->total_price,
            "verification_code" => $this->resource->verification_code,
            "status"            => $this->resource->status,
            "items"             => OrderItemsIndexResource::collection($this->whenLoaded("orderItems")),
        ];
    }
}
