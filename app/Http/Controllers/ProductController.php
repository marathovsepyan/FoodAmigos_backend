<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @param ProductService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, ProductService $service)
    {
        $products = $service->get(
            min($request->get('perPage', 10), 100), // get perPage, if empty then default is 10, max value 100
            $request->get('page', 1)
        );
        return response()->json([
            'data' => ProductResource::collection($products),
            'total' => $products->total(),
            'hasNextPage' => $products->hasMorePages(),
            'perPage' => $products->perPage(),
            'page' => $products->currentPage(),
        ]);
    }
}
