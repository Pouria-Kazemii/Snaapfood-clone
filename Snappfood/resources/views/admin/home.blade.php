@extends('layouts.admin')
@section('content')
    <h3 class="mt-3 text-center">welcome back ADMIN</h3>

    <h4 class="mt-5 text-center">comment delete requests:</h4>
    <div class="container mt-4 me-1  bg-secondary">
        <div class="row">
            <div class="col-md-10">
                @foreach($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="mb-3">
                            <h5 class="card-title">Customer:</h5>
                            <p class="card-text">{{$comment->customer->user->name}}</p>
                        </div>

                        <div class="mb-3">
                            <h5 class="card-title">Restaurant:</h5>
                                <p class="card-text">{{$comment->order->orderItems->first()->food->restaurant->name}}</p>
                        </div>

                        <div>
                            <h5 class="card-title">Comment:</h5>
                            <p class="card-text">{{$comment->body}}</p>
                        </div>

                        <div class="mt-3 d-flex">
                            <form action="/admin/{{$comment->id}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-m">Delete</button>
                            </form>
                            <form action="/admin/{{$comment->id}}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-warning btn-m ms-2">Stay</button>
                            </form>
                        </div>
                    </div>
                 </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
