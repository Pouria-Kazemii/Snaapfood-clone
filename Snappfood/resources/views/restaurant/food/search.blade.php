@extends('layouts.restaurant')

@section('content')
    <div class="container mt-4">
        <ul class="list-group">
            @foreach($foods as $food)
                <li class="list-group-item">
                    <a href="/restaurant/{{ $restaurant->name }}/foods/{{ $food->id }}">{{ $food->name }}</a>
                    @can('foodDelete' , $restaurant)
                    <form action="/restaurant/{{ $restaurant->name }}/foods/{{ $food->id }}" method="POST" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    @endcan
                    @can('foodUpdate' , $restaurant)
                    <a href="/restaurant/{{ $restaurant->name }}/foods/{{ $food->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                </li>
            @endforeach
        </ul>

        @if(count($foods) == 0)
            <h3>
                No food found
            </h3>
        @endif
    </div>
@endsection
