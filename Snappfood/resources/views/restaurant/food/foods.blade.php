@extends('layouts.restaurant')

@section('content')
    <div class="container mt-4">
        <div class="mb-3">
            <h3>
                Search For a Food
            </h3>
            <form action="/restaurant/{{ $restaurant->name }}/foods/search" method="POST" class="d-flex">
                @csrf
                <input type="text" name="search" class="form-control me-2" placeholder="Search for food...">
                <select class="form-select me-2" name="type_of_food">
                    @foreach($typeOfFoods as $typeOfFood)
                        <option value="{{ $typeOfFood->type }}">{{ $typeOfFood->type }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Search</button>
            </form>
        </div>

        @can('foodCreate' , $restaurant)
        <div class="mb-3">
            <a href="/restaurant/{{ $restaurant->name }}/foods/create" class="btn btn-primary">Add New Food</a>
        </div>
        @endcan

        <ul class="list-group">
            @foreach($foods as $food)
                <li class="list-group-item d-flex justify-content-between align-items-center">

                    <a href="/restaurant/{{ $restaurant->name }}/foods/{{ $food->id }}">{{ $food->name }}</a>

                    <div>
                        @can('foodDelete' , $restaurant)
                        <form action="/restaurant/{{ $restaurant->name }}/foods/{{ $food->id }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm me-2">Delete</button>
                        </form>
                        @endcan
                        @can('foodUpdate' , $restaurant)
                        <a href="/restaurant/{{ $restaurant->name }}/foods/{{ $food->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                        @endcan
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
