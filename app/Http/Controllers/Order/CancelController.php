<?php

namespace App\Http\Controllers\Order;

use App\Enums\{OrderItemsStatus, OrderStatus, PaymentStatus, ShippingStatus};
use App\Http\Controllers\Controller;
use App\Http\Requests\CancelOrderRequest;
use App\Models\Order;
use Symfony\Component\HttpFoundation\{Response};

class CancelController extends Controller
{
    public function cancel(CancelOrderRequest $request, $order)
    {
        $order = Order::withTrashed()
            ->where("uuid", $order)
            ->first();

        $order->update([
            "status"          => OrderStatus::CANCELED,
            "payment_status"  => PaymentStatus::CANCELED,
            "shipping_status" => ShippingStatus::CANCELED,
        ]);
        $order->delete();

        $order->orderItems()
            ->update([
                "status" => OrderItemsStatus::CANCELED,
            ]);
        $order->orderItems()
            ->delete();

        return response()->json(
            [
                "success" => "The order and the respective items related to the order have been canceled",
            ],
            Response::HTTP_OK
        );
    }
}
