<?php

namespace App\Http\Controllers\Order;

use App\Enums\{OrderItemsStatus, OrderStatus, PaymentStatus, ShippingStatus};
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function store(StoreOrderRequest $request)
    {
        $totalPrice = $this->calculateTotalPrice($request);

        $order = user()->orders()
            ->create([
                "uuid"              => Str::uuid(),
                "shipping_address"  => $request->shipping_address,
                "billing_address"   => $request->billing_address,
                "payment_method"    => $request->payment_method,
                "payment_status"    => PaymentStatus::PENDING,
                "shipping_method"   => $request->shipping_method,
                "shipping_status"   => ShippingStatus::PROCESSING,
                "shipping_costs_id" => $request->shipping_costs_id,
                "total_price"       => $totalPrice,
                "discount"          => $request->discount,
                "verification_code" => strtoupper(Str::random(10)),
                "status"            => OrderStatus::PENDING,
            ]);

        collect($request->items)->each(function ($item) use ($order) {
            $order->orderItems()->create([
                "uuid"        => Str::uuid(),
                "product_id"  => $item["product_id"],
                "quantity"    => $item["quantity"],
                "unit_price"  => $item["unit_price"],
                "total_price" => $item["unit_price"] * $item["quantity"],
                "tracking"    => now()->timestamp . rand(100, 999),
                "status"      => OrderItemsStatus::PENDING,
            ]);
        });

        return OrderResource::make($order);
    }

    private function calculateTotalPrice(StoreOrderRequest $request)
    {
        $totalPrice = collect($request->items)->reduce(function ($acc, $item) {
            return $acc + ($item["unit_price"] * $item["quantity"]);
        }, 0);

        return $totalPrice - $request->discount;
    }
}
