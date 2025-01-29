<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Resources\Order\OrderCreateResource;
use App\Services\Order\CreateOrderService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{
    public function __construct(protected CreateOrderService $orderService)
    {
    }

    public function __invoke(StoreOrderRequest $request): OrderCreateResource|JsonResponse
    {
        try {
            $order = $this->orderService
                ->create($request->validated());

            return $this->successResponse(
                message: "Order created successfully",
                status: Response::HTTP_CREATED,
                data: OrderCreateResource::make($order),
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
