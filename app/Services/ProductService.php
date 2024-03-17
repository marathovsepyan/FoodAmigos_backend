<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * @param int $perPage
     * @param int $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function get(int $perPage, int $page=1)
    {
        return Product::query()->orderBy('created_at', 'desc')->paginate(perPage: $perPage, page: $page);
    }
}
