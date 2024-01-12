@extends('layouts.restaurant')

@section('content')
    @php
        $totalOrder = 0;
        $totalAmount = 0;
    @endphp

    @if($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="list-unstyled mb-0">
                @foreach($errors->all() as $error)
                    <li class="text-warning">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="mt-4">Specify Data</h2>
    @can('sellReportSearch' , $restaurant)
    <form action="/restaurant/{{$restaurant->name}}/sell_report" method="POST">
        @csrf
        <div class="mb-3">
            <input name="start_time" placeholder="Start Time" type="date" class="form-control">
        </div>
        <div class="mb-3">
            <input name="end_time" placeholder="End Time" type="date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    @endcan

    <h1 class="mt-4">Sell Report</h1>

    @foreach($orders as $order)
        @if($order->orderItems->first()->food->restaurant->name == $restaurant->name)
            @php
                $totalOrder++;
                $totalAmount += $order->total_amount;
            @endphp

            <h3 class="mt-4">
                Order Id: {{$order->id}}
            </h3>

            <h5>Order Items:</h5>
            <ul>
                @foreach($order->orderItems as $orderItem)
                    <li>
                        Food Name: {{$orderItem->food->name}}
                    </li>
                    <li>
                        Quantity: {{$orderItem->quantity}}
                    </li>
                @endforeach
            </ul>

            <h6>
                Price Of This Order: {{$order->total_amount}}
            </h6>
        @endif
    @endforeach

    <h3 class="mt-4">Total Order Number: {{$totalOrder}}</h3>
    <h3>Total Income: {{$totalAmount}}</h3>
@endsection
