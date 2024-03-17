<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBasketRequest;
use App\Http\Requests\UpdateBasketRequest;
use App\Http\Resources\BasketResource;
use App\Services\BasketService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    /**
     * @param Request $request
     * @param BasketService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, BasketService $service)
    {
        $baskets = $service->get(
            Auth::id(),
            min($request->get('perPage', 10), 100), // get perPage, if empty then default is 10, max value 100
            $request->get('page', 1)
        );

        return $this->paginatedResponse(
            $baskets,
            BasketResource::collection($baskets)
        );
    }

    /**
     * @param $productId
     * @param BasketService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBasketRequest $request, BasketService $service)
    {
        $basket = $service->store(Auth::id(), $request->validated());

        return response()->json([
            'data' => new BasketResource($basket)
        ]);
    }

    /**
     * @param $basketId
     * @param UpdateBasketRequest $request
     * @param BasketService $service
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function update($basketId, UpdateBasketRequest $request,  BasketService $service)
    {
        $service->update($basketId, $request->validated());

        return response('', Response::HTTP_NO_CONTENT);
    }

    public function delete($basketId, BasketService $service)
    {
        $service->delete($basketId, Auth::id());

        return response('', Response::HTTP_NO_CONTENT);
    }
}
