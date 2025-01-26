<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\CancelOrderRequest;
use App\Models\Order;
use App\Services\Order\CancelOrderService;
use Symfony\Component\HttpFoundation\{Response};

class CancelController extends Controller
{
    public function __construct(protected CancelOrderService $orderService)
    {
    }

    public function cancel(CancelOrderRequest $request, Order $order)
    {
        try {
            $canceled = $this->orderService->cancel($order);

            if ($canceled) {
                return response()->json(
                    [
                        "success" => "The order and the respective items related to the order have been canceled",
                    ],
                    Response::HTTP_OK
                );
            }

        } catch (\Exception $e) {
            return response()->json(["error" => "Unexpected error"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
