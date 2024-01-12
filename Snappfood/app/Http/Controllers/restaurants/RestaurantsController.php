<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantsController extends Controller
{
    public function index(string $name)
    {

        $orders = Order::where('is_finished' , false)->get();
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('ordersRead', $restaurant);

        return view('restaurant.home' , [
            'restaurant' => $restaurant,
            'orders' => $orders
        ]);
    }

    public function orders(Request $request, string $name , int $id )
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('ordersUpdate', $restaurant);

        Order::where('id' , $id)->update([
            'status' => $request->input('status')
        ]);
        if ($request->input('status') == 'delivered'){
            Order::find($id)->update([
                'is_finished' => true
            ]);
        } ;

        return redirect()->route('restaurant.home' , [
            'name' => $name
            ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
