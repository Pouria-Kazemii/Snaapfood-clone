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
        return [
            'id' => $this->id,
            'restaurant' => [
                'title' => $this->getRestaurant()->name,
                'image' => $this->getRestaurant()->profile_image_path
            ],
            'foods' => $this->orderItems->map(function ($orderItem) {
                return [
                    'id' => $orderItem->food->id ,
                    'title' => $orderItem->food->name,
                    'count' => $orderItem->quantity ,
                    'price' => $orderItem->quantity * $orderItem->food->price
                ];
            }),
        ];
    }


        function getRestaurant()
        {
            return $this->orderItems->first()->food->restaurant;
        }

}
