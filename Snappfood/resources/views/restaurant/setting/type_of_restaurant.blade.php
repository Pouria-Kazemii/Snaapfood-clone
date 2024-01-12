@extends('layouts.restaurant')

@section('content')
    <div class="container mt-4">
        <h1>Types Of Restaurant</h1>

        @if($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li class="text-warning">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3>Select types of your restaurant</h3>
        <form action="/restaurant/{{$restaurant->name}}/settings/type_of_restaurant" method="POST">
            @csrf
            @foreach($typesOfRestaurant as $typeOfRestaurant)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="{{$typeOfRestaurant->type}}" name="options[]" value="{{$typeOfRestaurant->id}}">
                    <label class="form-check-label" for="{{$typeOfRestaurant->type}}">{{$typeOfRestaurant->type}}</label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-warning mt-2">Submit</button>
        </form>

        <h3>Your selected types</h3>

        @foreach($restaurant->restaurantTypes as $restaurantType)
            <form action="/restaurant/{{$restaurant->name}}/settings/type_of_restaurant/{{$restaurantType->id}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="mb-3">
                    <h4>{{$restaurantType->typeOfRestaurant->type}}</h4>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        @endforeach
    </div>
@endsection
