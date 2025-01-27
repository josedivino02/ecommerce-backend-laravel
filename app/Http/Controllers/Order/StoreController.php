<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\Order\OrderCreateResource;
use App\Services\Order\CreateOrderService;

class StoreController extends Controller
{
    public function __construct(protected CreateOrderService $orderService)
    {
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->create($request->validated());

        return OrderCreateResource::make($order);
    }

}