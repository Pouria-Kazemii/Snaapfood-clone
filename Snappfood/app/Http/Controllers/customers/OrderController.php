<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private static $user;

    public function __construct()
    {
        $this::$user = auth()->guard('sanctum')->user();
    }

    public function index()
    {
        if ($this::$user->customer->orders->count() == 0) {
            return response()->json(['error' => 'no order found'], 404);
        }
            return response()->json(['orders' => OrderResource::collection($this::$user->customer->orders)]);
    }
    public function store(Request $request)
    {

        $user = $this::$user;
        $customer = $user->customer;
        $foodId = $request->input('food_id');
        $count = $request->input('count');


        $order = $customer->orders->last();

        if ($order && !$order->is_finished) {
            $firstFood = $order->orderItems->first()->food;


            if ($firstFood->restaurant->name != Food::find($foodId)->restaurant->name) {
                return response()->json(['error' => 'This food belongs to another restaurant'], 403);
            }
        }


        if (!$order || !$order->is_finished || $firstFood->restaurant->name == Food::find($foodId)->restaurant->name) {
            $totalAmount = $order ? $order->total_amount : 0;

            if (!$order) {

                $order = Order::create([
                    'customer_id' => $customer->id,
                    'total_amount' => Food::find($foodId)->price * $count,
                ]);
            }


            OrderItem::create([
                'quantity' => $count,
                'food_id' => $foodId,
                'order_id' => $order->id,
            ]);


            $totalAmount += Food::find($foodId)->price * $count;
            $order->update(['total_amount' => $totalAmount]);

            return response()->json(['msg' => 'Food added to cart successfully', 'cart_id' => $order->id]);
        }

        return response()->json(['error' => 'Unable to add food to cart.'], 403);

    }

    public function update(Request $request)
    {
        $user = $this::$user;
        $customer = $user->customer;
        $foodId = $request->input('food_id');
        $newQuantity = $request->input('count');

        // Retrieve the last open order for the customer
        $order = $customer->orders->last();

        // Check if the order is open
        if ($order && !$order->is_finished) {
            // Check if the food item exists in the order
            $orderItem = $order->orderItems()->where('food_id', $foodId)->first();

            if ($orderItem) {
                // Update the quantity of the existing food item
                $orderItem->update(['quantity' => $newQuantity]);

                // Update the total amount of the order
                $order->update(['total_amount' => $order->calculateTotalAmount()]);

                return response()->json(['msg' => 'Cart updated successfully', 'cart_id' => $order->id]);
            } else {
                return response()->json(['error' => 'Food item not found in the cart'], 404);
            }
        }

        return response()->json(['error' => 'Unable to update cart.'], 403);
    }


    public function read(string $id)
    {
        $order = Order::find($id);
        if ($order == null) {
            return response()->json(['error' => 'no order found'], 404);
        }

        if($order->customer_id == $this::$user->customer->id ){
            return response()->json(['order' => OrderResource::make($order)]);
        }else{
            return response()->json(['error' => 'Forbidden'] , 403);
        }
    }

    public function pay(string $id)
    {
        $order = Order::find($id);

        if ($order == null){
            return response()->json(['error' => 'Not Found'] , 404);
        }

        if ($order->customer_id != $this::$user->customer->id){
            return response()->json(['error' => 'This Order Belongs To Another Person'] , 403);
        }

        if ($order->is_finished){
            return response()->json(['error' => 'You payed for this order before'] , 422);
        }

        $order->update([
            'is_finished' => true
        ]);

        return response()->json(['msg' => 'Payment was successful']);

    }

}
