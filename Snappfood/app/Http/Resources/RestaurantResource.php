<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantResource extends JsonResource
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
            'title' => $this->name,
            'type' => $this->restaurantTypes->map(function ($restaurantType){
                return $restaurantType->typeOfRestaurant->type;
            }),
            'address' => [
                'address' => $this->address,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ],
            'is_open' => $this->is_open,
            'image' => $this->profile_image_path,
            'score' => $this->getAverageScore(),
            'comment_counts' => $this->getTotalComments(),
            'schedule' => $this->getSchedule(),
        ];
    }

    private function getAverageScore(): float
    {
        $comments = $this->getComments();

        $totalScores = $comments->sum('score');
        $totalComments = $comments->count();

        return $totalComments > 0 ? $totalScores / $totalComments : 0;
    }

    private function getTotalComments(): int
    {
        return $this->getComments()->count();
    }

    private function getComments()
    {
        return Comment::whereHas('order.orderItems.food.restaurant', function ($query) {
            $query->where('id', $this->id);
        })->get();
    }

    private function getSchedule(): array
    {
        $days = ['saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $schedule = [];

        foreach ($days as $day) {
            $schedule[$day] = $this->getDaySchedule($day);
        }

        return $schedule;
    }

    private function getDaySchedule(string $day): array
    {
        $daySchedule = $this->restaurantHoures->where('day', $day)->first();

        return $daySchedule
            ? ['start' => $daySchedule->opening_time, 'end' => $daySchedule->closing_time]
            : ['start' => null, 'end' => null];
    }
}

