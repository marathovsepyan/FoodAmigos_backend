<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param LengthAwarePaginator $paginator
     * @param AnonymousResourceCollection $resource
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function paginatedResponse(LengthAwarePaginator $paginator, AnonymousResourceCollection $resource, int $code=200)
    {
        return response()->json([
            'data' => $resource,
            'total' => $paginator->total(),
            'hasNextPage' => $paginator->hasMorePages(),
            'perPage' => $paginator->perPage(),
            'page' => $paginator->currentPage(),
        ], $code);
    }
}
