<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone_number', 'shipping_address', 'status', 'total', 'ordered_by',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('count', 'current_product_price', 'note')
            ->withTimestamps();
    }

}
