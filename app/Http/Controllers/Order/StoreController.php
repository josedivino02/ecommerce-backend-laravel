<?php

namespace App\Http\Controllers\Order;

use App\Enums\{OrderStatus, PaymentStatus, ShippingStatus};
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $order = user()->orders()
            ->create([
                'shipping_address'  => $request->shipping_address,
                'billing_address'   => $request->billing_address,
                'payment_method'    => $request->payment_method,
                'payment_status'    => PaymentStatus::PENDING,
                'shipping_method'   => $request->shipping_method,
                'shipping_status'   => ShippingStatus::PROCESSING,
                'shipping_cost'     => $request->shipping_cost,
                'total_price'       => $request->total_price,
                'discount'          => $request->discount,
                'verification_code' => strtoupper(Str::random(10)),
                'status'            => OrderStatus::PENDING,
            ]);

        return OrderResource::make($order);
    }
}
