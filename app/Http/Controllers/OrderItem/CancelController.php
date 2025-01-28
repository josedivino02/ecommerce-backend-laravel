<?php

namespace App\Http\Controllers\OrderItem;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderItem\CancelOrderItemRequest;
use App\Models\{Order, OrderItem};
use App\Services\Item\CancelItemService;
use Symfony\Component\HttpFoundation\Response;

class CancelController extends Controller
{
    public function __construct(protected CancelItemService $itemService)
    {
    }

    public function cancel(CancelOrderItemRequest $request, Order $order, OrderItem $item)
    {
        try {
            $canceledItem = $this->itemService->cancel($order, $item);

            if ($canceledItem) {
                return response()->json(
                    [
                        "success" => "The item related to the order have been canceled",
                    ],
                    Response::HTTP_OK
                );
            }
        } catch (\Exception $e) {
            return response()->json(["error" => "Unexpected error"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}