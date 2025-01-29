<?php

namespace App\Http\Controllers\OrderItem;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderItem\CancelOrderItemRequest;
use App\Models\{Order, OrderItem};
use App\Services\Item\CancelItemService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CancelController extends Controller
{
    public function __construct(protected CancelItemService $itemService)
    {
    }

    public function __invoke(CancelOrderItemRequest $request, Order $order, OrderItem $item): JsonResponse
    {
        try {
            $canceledItem = $this->itemService
                ->cancel($order, $item);

            if (!$canceledItem) {
                return $this->errorResponse(
                    message :"The item related to the order not have been canceled",
                    status: Response::HTTP_BAD_REQUEST
                );
            }

            return $this->successResponse(
                message: "The item related to the order have been canceled",
                status: Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}