<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchSellReportRequest;
use App\Models\Order;
use App\Models\Restaurant;

class SellReportController extends Controller
{
    public function index(string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();
        $orders = Order::where('is_finished' , true)->get();

        $this->authorize('sellReportRead' , $restaurant);

        return view('restaurant.sell_report.index')->with(['restaurant' => $restaurant,
        'orders' => $orders]);
    }

    public function search(SearchSellReportRequest $request,string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('sellReportSearch' , $restaurant);

        $orders = Order::whereDate('created_at', '>=', $request->input('start_time'))
            ->whereDate('created_at', '<=', $request->input('end_time'))
            ->where('is_finished' , true)
            ->get();


        return view('restaurant.sell_report.index')->with(['restaurant' => $restaurant,
            'orders' => $orders]);
    }



}
