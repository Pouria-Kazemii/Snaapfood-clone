<?php

namespace App\Http\Controllers\customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentController extends Controller
{

    private function sendErrorResponse($errors, $status = 422)
    {
        return response()->json(['errors' => $errors], $status);
    }

    public function index(Request $request)
    {
        $food_id = $request->input('food_id');
        $restaurant_id = $request->input('restaurant_id');

        if ($food_id == null and $restaurant_id == null) {
            return response()->json(['error' => 'You must enter a value at least']);
        }

        if ($food_id != null and $restaurant_id == null){

            if (Food::find($food_id) == null) {
                return response()->json(['error' => 'Not Fount'] , 404);
            }

            $comments = Comment::whereHas('order.orderItems.food', function ($query) use ($food_id) {
                $query->where('foods.id', $food_id);
            })->where('is_confirmed' , true)->get();

            return response(['comments' =>CommentResource::collection($comments)]);
        }

       if ($restaurant_id != null and $food_id == null){
           if (Restaurant::find($restaurant_id) == null){
                return response()->json(['error' => 'Not Found'] , 404);
           }

           $comments = Comment::whereHas('order.orderItems.food.restaurant', function ($query) use ($restaurant_id) {
               $query->where('restaurants.id', $restaurant_id);
           })->where('is_confirmed' , true)->get();

           return response(['comments' =>CommentResource::collection($comments)]);

       }

       if ($restaurant_id != null and $food_id!= null){

           $comments = Comment::whereHas('order.orderItems.food.restaurant', function ($query) use ($restaurant_id , $food_id) {
               $query->where('restaurants.id', $restaurant_id)->where('foods.id' , $food_id);
           })->where('is_confirmed' , true)->get();

           return response(['comments' =>CommentResource::collection($comments)]);
       }

       return response()->json(['error' => 'internal server error'] , 500);

    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'order_id' => 'required',
                'score' => 'required|integer|min:0|max:5',
                'body' => 'required|string|max:100|min:10'
            ];

            $validData = $request->validate($rules);


            $order = Order::find($validData[('order_id')]);

            if ($order == null){
                return response()->json(['error' => 'Order not found'] , 404);
            }

            if ($order->customer_id != auth()->guard('sanctum')->user()->customer->id){
                return response()->json(['error' => 'This order not belongs to you'] , 403);
            }

            if (!$order->is_finished){
                return response()->json(['error' => 'you must finish order first'] , 401);
            }

            Comment::create([
                'score' => $validData['score'],
                'body' => $validData['body'],
                'customer_id' => auth()->guard('sanctum')->user()->customer->id,
                'order_id' => $validData['order_id']
            ]);

            return response()->json(['msg' => 'comment added successfully']);
        }catch (ValidationException $e){
            return $this->sendErrorResponse($e->errors() , $e->status);
        }
    }
}
