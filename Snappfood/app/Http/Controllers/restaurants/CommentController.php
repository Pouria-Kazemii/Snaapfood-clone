<?php

namespace App\Http\Controllers\restaurants;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private static $comments;

    public function __construct()
    {
        $this::$comments = Comment::where('request_for_deleting' , false)
            ->where('is_confirmed' , false)
            ->get();
    }

    public function index(string $name)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        return view('restaurant.comment.index')->with([
            'restaurant' => $restaurant ,
            'comments' => $this::$comments,
            ]);
    }

    public function delete(string $name,string $id)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('commentDelete' , $restaurant);

        Comment::find($id)->update([
            'request_for_deleting' => true
        ]);

        return redirect("restaurant/$restaurant->name/comments")->with([
            'restaurant' => $restaurant ,
            'comments' => $this::$comments,
            ]);

    }

    public function confirm(string $name, string $id)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $this->authorize('commentConfirm' , $restaurant);

        Comment::find($id)->update([
            'is_confirmed' => true
        ]);

        return redirect("restaurant/$restaurant->name/comments")->with([
            'restaurant' => $restaurant ,
            'comments' => $this::$comments,
        ]);

    }

    public function sendResponse(string $name,string $id, Request $request)
    {
        $restaurant = Restaurant::where('name' , $name)->first();

        $request->validate([
            'response' => 'required']);

        $this->authorize('commentUpdate' , $restaurant);

        Comment::find($id)->update([
            'response' => $request->input('response')
        ]);

        return redirect("restaurant/$restaurant->name/comments")->with([
            'restaurant' => $restaurant ,
            'comments' => $this::$comments,
        ]);
    }

}
