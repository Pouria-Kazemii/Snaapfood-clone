@extends('layouts.restaurant')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach($comments as $comment)
        @if($comment->order->orderItems->first()->food->restaurant->name == $restaurant->name)
            <div class="mb-4">
                <h3>Comment ID: {{$comment->id}}</h3>
                <ul class="list-unstyled">
                    <li>Score: {{$comment->score}}</li>
                    <li>Body of Comment: {{$comment->body}}</li>
                    <li>Customer Name: {{$comment->customer->user->name}}</li>
                    <li>response : {{$comment->response}}</li>
                    <h4>Order Items</h4>
                    @foreach($comment->order->orderItems as $orderItem)
                        <li>Food Name: {{$orderItem->food->name}}</li>
                        <li>Quantity: {{$orderItem->quantity}}</li>
                    @endforeach
                </ul>

                @can('commentDelete' , $restaurant)
                <form action="/restaurant/{{ $restaurant->name }}/comments/{{$comment->id}}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm me-2">Delete</button>
                </form>
                @endcan

                @can('commentConfirm' , $restaurant)
                <form action="/restaurant/{{ $restaurant->name }}/comments/{{$comment->id}}" method="POST" class="d-inline">
                    @method('PUT')
                    @csrf
                    <button type="submit" class="btn btn-warning btn-sm me-2">Confirm</button>
                </form>
                @endcan

                @can('commentUpdate' , $restaurant)
                <form action="/restaurant/{{ $restaurant->name }}/comments/{{$comment->id}}" method="POST" class="d-inline">
                    @method('POST')
                    @csrf
                    <div class="input-group">
                        <input type="text" name="response" class="form-control" placeholder="Send your response">
                        <button type="submit" class="btn btn-warning btn-sm">Send Response</button>
                    </div>
                </form>
                @endcan
            </div>
        @endif
    @endforeach
@endsection
