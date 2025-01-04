<?php

namespace App\Http\Controllers\OrderItem;

use App\Enums\OrderItemsStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CancelOrderItemRequest;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;

class CancelController extends Controller
{
    public function cancel(CancelOrderItemRequest $request)
    {
        $order = Order::withTrashed()
            ->where("uuid", $request->order)
            ->first();

        $item = $order->orderItems()
            ->withTrashed()
            ->where("uuid", $request->item)
            ->first();

        dd($item);
        $item->update([
            "status" => OrderItemsStatus::CANCELED,
        ]);
        $item->delete();

        return response()->json(
            [
                "success" => "The item related to the order have been canceled",
            ],
            Response::HTTP_OK
        );
    }

}
