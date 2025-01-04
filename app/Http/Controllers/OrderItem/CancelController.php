<?php

namespace App\Http\Controllers\OrderItem;

use App\Enums\OrderItemsStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CancelOrderItemRequest;
use App\Models\{Order, OrderItem};
use Symfony\Component\HttpFoundation\Response;

class CancelController extends Controller
{
    public function cancel(CancelOrderItemRequest $request, Order $order, OrderItem $item)
    {
        try {
            $order->update([
                "total_price" => ($order->total_price - $item->total_price),
            ]);

            $item->update([
                "status" => OrderItemsStatus::CANCELED,
            ]);

            return response()->json(
                [
                    "success" => "The item related to the order have been canceled",
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json(["error" => "Unexpected error"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
