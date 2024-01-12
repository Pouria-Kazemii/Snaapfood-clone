@extends('layouts.restaurant')

@section('content')
    <div class="container mt-4">
        @if ($food and !$food->is_deleted)
            @if ($food->restaurant_id == $restaurant->id)
                <ul class="list-group">
                    <li class="list-group-item">Name: {{ $food->name }}</li>
                    <li class="list-group-item">Raw Material: {{ $food->raw_material }}</li>
                    <li class="list-group-item">Price: {{ $food->price }}</li>
                    <li class="list-group-item">Type: {{ $food->typeOfFood->type }}</li>
                    @can('discountRead' , $restaurant)
                    <li class="list-group-item">Discounts:
                        <ul class="list-group">
                            @foreach ($food->discounts as $discount)
                                <li class="list-group-item">Value: {{ $discount->value }}</li>
                                <li class="list-group-item">Percent: {{ $discount->percent }}</li>
                            @endforeach
                        </ul>
                    </li>
                    @endcan
                    <li class="list-group-item">
                        <img style="height: 400px;width:100%" class="img-fluid" src="{{ Storage::url("public/pictures/foods/$food->image_path") }}" alt="Food Image">
                    </li>
                </ul>

                <div class="mt-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @can('discountCreate' , $restaurant)
                    <h2>Create Discount</h2>
                    <form action="/restaurant/{{ $restaurant->name }}/foods/{{ $food->id }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="percent" class="form-label">Percent:</label>
                            <input type="number" class="form-control" id="percent" name="percent">
                        </div>
                        <button type="submit" class="btn btn-warning">Create Discount</button>
                    </form>
                        @endcan
                        @can('foodPartyCreate' , $restaurant)
                        <h2 class="mt-3">Adding To Food Party</h2>
                        <form action="/restaurant/{{ $restaurant->name }}/foods/{{ $food->id }}/add_to_food_party" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="percent" class="form-label">Percent:</label>
                                <input type="number" class="form-control" id="percent" name="percent">
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="number" class="form-control" id="quantity" name="quantity">
                            </div>
                            <button type="submit" class="btn btn-warning">Adding</button>
                        </form>
                        @endcan
                </div>
            @else
                <h2 class="mt-4">This food does not belong to your restaurant</h2>
            @endif
        @else
            <h3 class="mt-4">This food does not exist</h3>
        @endif
    </div>
@endsection
