<?php

namespace App\Order\Http\Resources;

use App\Order\Models\Order;
use App\OrderItem\Http\Resources\OrderItemsCreateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Order $resource
 */
class OrderCreateResource extends JsonResource
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
            "verification_code" => $this->resource->verification_code,
            "shipping_address"  => $this->resource->shipping_address,
            "payment_method"    => $this->resource->payment_method,
            "payment_status"    => $this->resource->payment_status,
            "shipping_method"   => $this->resource->shipping_method,
            "shipping_status"   => $this->resource->shipping_status,
            "shipping_cost"     => $this->resource->shipping_cost,
            "discount"          => $this->resource->discount,
            "total_price"       => $this->resource->total_price,
            "status"            => $this->resource->status,
            "items"             => OrderItemsCreateResource::collection($this->resource->orderItems),
            "created_by"        => [
                "uuid"  => $this->resource->user->uuid,
                "email" => $this->resource->user->email,
                "name"  => $this->resource->user->name,
            ],
            "created_at" => $this->resource->created_at->format("Y-m-d H:i:s"),
            "updated_at" => $this->resource->updated_at->format("Y-m-d H:i:s"),
        ];
    }
}
