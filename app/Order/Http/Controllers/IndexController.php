<?php

namespace App\Order\Http\Controllers;

use App\Common\Http\Controllers\Controller;
use App\Order\Http\Resources\OrderIndexResource;
use App\Order\Services\ListPaginatedOrderService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\{JsonResponse, Request};
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function __construct(protected ListPaginatedOrderService $orderService)
    {
    }

    public function __invoke(Request $request): AnonymousResourceCollection|JsonResponse
    {
        try {
            $orders = $this->orderService
                ->listPaginated($request->all());

            return OrderIndexResource::collection($orders);
        } catch (\Exception) {
            return $this->errorResponse(
                message :"Unexpected error",
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
