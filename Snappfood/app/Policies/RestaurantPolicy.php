<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\User;

class RestaurantPolicy
{
    /**
     * Create a new policy instance.
     */

    public function ordersRead(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function ordersUpdate(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function foodCreate(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function foodUpdate(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function foodDelete(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function discountRead(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function discountCreate(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function foodPartyCreate(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function sellReportRead(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function sellReportSearch(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function commentConfirm(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function commentUpdate(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function commentDelete(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }

    public function setting(User $user, Restaurant $restaurant)
    {
        return $user->restaurant->id == $restaurant->id;
    }


}


