<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        $comments = Comment::where('request_for_deleting' , true)->get();
        return view('admin.home',[
            'comments' => $comments
        ]);
    }

    public function deleteComment(string $id)
    {
        Comment::find($id)->delete();

        return redirect()->route('admin.home');
    }

    public function stayComment(string $id)
    {
        Comment::find($id)->update([
            'request_for_deleting' => false
        ]);

        return redirect()->route('admin.home');

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
