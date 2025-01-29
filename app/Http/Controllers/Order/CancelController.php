<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\CancelOrderRequest;
use App\Models\Order;
use App\Services\Order\CancelOrderService;
use Symfony\Component\HttpFoundation\{JsonResponse, Response};

class CancelController extends Controller
{
    public function __construct(protected CancelOrderService $orderService)
    {
    }

    public function __invoke(CancelOrderRequest $request, Order $order): JsonResponse
    {
        try {
            $canceled = $this->orderService
                ->cancel($order);

            if (!$canceled) {
                return $this->errorResponse(
                    message :"The order and the respective items related to the order no have been canceled",
                    status: Response::HTTP_BAD_REQUEST
                );
            }

            return $this->successResponse(
                message: "The order and the respective items related to the order have been canceled",
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