<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\NewOrderCreated;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(Request $request, OrderService $service)
    {
        $orders = $service->get(Auth::id(),
            min($request->get('perPage', 10), 100), // get perPage, if empty then default is 10, max value 100
            $request->get('page', 1)
        );

        return $this->paginatedResponse(
            $orders,
            OrderResource::collection($orders)
        );
    }

    /**
     * @param StoreOrderRequest $request
     * @param OrderService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOrderRequest $request,OrderService $service)
    {
        $order = $service->store(Auth::id(), $request->validated());

        if ($order instanceof Order) {
            NewOrderCreated::dispatch($order, Auth::user())
                ->delay(now()->addMinutes(3))
            ;
            return response()->json(new OrderResource($order));
        } else {
            return response()->json($order, 400);
        }
    }
}
