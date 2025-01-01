<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "message" => "Order created successfully",
            'data'    => [
                'id'                => $this->id,
                'shipping_address'  => $this->shipping_address,
                'billing_address'   => $this->billing_address,
                'payment_method'    => $this->payment_method,
                'payment_status'    => $this->payment_status,
                'shipping_method'   => $this->shipping_method,
                'shipping_status'   => $this->shipping_status,
                'shipping_cost'     => $this->shipping_cost,
                'total_price'       => $this->total_price,
                'discount'          => $this->discount,
                'verification_code' => $this->verification_code,
                'status'            => $this->status,
                "items"             => OrderItemsResource::collection($this->orderItems),
                'created_by'        => [
                    "id"    => $this->user->id,
                    "name"  => $this->user->name,
                    "email" => $this->user->email,
                ],
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
            ],
        ];
    }
}
