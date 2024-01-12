@extends('layouts.restaurant')
@section('content')
    <div class=" p-4 mb-4 text-center">
        <h1 class="text-dark">ORDERS:</h1>
    </div>

    <div class="container">
        @foreach($orders as $order)
            @if($order->orderItems->first()->food->restaurant->name == $restaurant->name)
                <div class="bg-light p-3 mb-3 rounded">
                    <ul class="list-unstyled">
                        <li class="mb-2">Order ID: {{$order->id}}</li>
                        <li class="mb-2">Customer Name: {{$order->customer->user->name}}</li>
                        <li class="mb-2">Customer Address: {{$order->customer->findMainAddress()->address}}</li>
                        <ul class="list-unstyled">
                            <li>Foods : </li>
                            @foreach($order->orderItems as $orderItem)
                                <li class="mb-1">{{$orderItem->food->name}} * {{$orderItem->quantity}}</li>
                            @endforeach
                        </ul>
                        <li class="mb-2">Status: {{$order->status}}</li>
                        <li class="mb-2">Total Amount: {{$order->total_amount}}</li>
                    </ul>
                    @can('ordersUpdate' , $restaurant)
                    <form action="/restaurant/{{$restaurant->name}}/{{$order->id}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label">Change Status:</label>
                            <select class="form-select" id="status" name="status">
                                <option value="preparing">Preparing</option>
                                <option value="send to destination">Send to destination</option>
                                <option value="delivered">Delivered</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                    @endcan
                </div>
            @endif
        @endforeach
    </div>

@endsection
