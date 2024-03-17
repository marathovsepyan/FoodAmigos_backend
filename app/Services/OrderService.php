<?php

namespace App\Services;

use App\Models\Basket;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function get(int $userId, int $perPage, int $page=1)
    {
        return Order::with('products')
            ->where('ordered_by', $userId)
            ->paginate(perPage: $perPage, page: $page);
    }

    /**
     * @param $userId
     * @param array $data
     * @return mixed
     */
    public function store($userId, array $data)
    {
        return DB::transaction(function() use ($data, $userId){

            // get basket items
            $basketService = new BasketService();

            $baskets = $basketService->all($userId);

            if (!$baskets->count()) {
                return [
                    'error' => 'Empty basket'
                ];
            }
            $total = 0;
            $pivotData = [];
            foreach ($baskets as $basket) {
                $total += $basket->product->price;
                $pivotData[$basket->product_id] = [
                    'count' => $basket->count,
                    'current_product_price' => $basket->product->price,
                    'note' => $basket->note,
                ];
            }

            if ($total < 15) {
                return [
                    'error' => 'Min order amount 15 euros'
                ];
            }

           $order = Order::create([
               'ordered_by' => $userId,
               'status' => 'pending',
               'total' => $total
           ] + $data);

            $order->products()->sync($pivotData);


            // delete basket
            Basket::where('user_id', $userId)->delete();

            return $order;
        });
    }
}
