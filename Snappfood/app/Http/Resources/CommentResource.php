<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'author' => [
                'name' => $this->customer->user->name
            ],
            'foods' => [
                $this->order->orderItems->map(function ($orderItem){
                    return $orderItem->food->name;
                })
            ],
            'score' => $this->score,
            'content' => $this->body,
             'answer' => $this->response
        ];
    }
}
