<?php

namespace App\Order\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Order\DTOs\CreateOrderDTO;
use App\Order\Http\Requests\StoreOrderRequest;
use App\Order\Http\Resources\OrderCreateResource;
use App\Order\Services\CreateOrderService;

use Symfony\Component\HttpFoundation\{JsonResponse, Response};

class StoreController extends Controller
{
    public function __construct(protected CreateOrderService $orderService)
    {
    }

    public function __invoke(StoreOrderRequest $request): OrderCreateResource|JsonResponse
    {
        try {
            $orderDTO = CreateOrderDTO::make($request->validated());

            $order = $this->orderService
                ->create($orderDTO);

            return $this->successResponse(
                message: "Order created successfully",
                status: Response::HTTP_CREATED,
                data: OrderCreateResource::make($order),
            );
        } catch (\Exception) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
