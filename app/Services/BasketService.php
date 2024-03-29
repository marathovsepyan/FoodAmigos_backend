<?php

namespace App\Services;

use App\Models\Basket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BasketService
{
    /**
     * @param int $userId
     * @param int $perPage
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function get(int $userId, int $perPage, int $page=1)
    {
        return Basket::query()
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(perPage: $perPage, page: $page);
    }

    public function all($userId)
    {
        return Basket::query()
            ->with('product')
            ->where('user_id', $userId)
            ->get();
    }

    public function store($userId, array $data)
    {
        return Basket::firstOrCreate([
            'user_id' => $userId,
            'product_id' => $data['productId']
        ], [
            'count' => $data['count'] ?? 1
        ]);
    }

    public function update($basketId, array $data)
    {
        return Basket::where('id', $basketId)->update($data);
    }

    /**
     * @param $basketId
     * @param $userId
     * @return mixed
     */
    public function delete($basketId, $userId)
    {
        return Basket::where('id', $basketId)->where('user_id', $userId)->delete();
    }
}
