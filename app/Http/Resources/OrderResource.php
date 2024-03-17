<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone_number' => $this->phone_number,
            'shipping_address' => $this->shipping_address,
            'status' => $this->status,
            'total' => $this->total,
            'created_at' => $this->created_at,
            'products' => ProductResource::collection($this->products),
        ];
    }
}
