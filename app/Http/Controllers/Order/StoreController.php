<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\Order\OrderService;

class StoreController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->create($request->validated());

        return OrderResource::make($order);
    }

}
