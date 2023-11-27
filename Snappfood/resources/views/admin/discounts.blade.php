@extends('layouts.admin')
@section('content')
    <div class="container mt-4">

        @if($errors)
            <div class="mt-4 text-left">
                @foreach($errors->all() as $error)
                    <li class="text-warning">
                        {{$error}}
                    </li>
                @endforeach
            </div>
        @endif
        <h2>Create Discount</h2>
        <form action="/admin/discounts" method="post">
            @csrf

            <div class="mb-3">
                <label for="percent" class="form-label">Percent:</label>
                <input type="number" class="form-control" id="percent" name="percent">
            </div>

            <div class="mb-3">
                <label for="food_id" class="form-label">Select Food:</label>
                <select class="form-select" id="food_id" name="food_id">
                    @foreach($foods as $food)
                        <option value="{{ $food->id }}">{{ $food->name }} of restaurant {{$food->restaurant->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create Discount</button>
        </form>
    </div>

    <div class="container mt-4 ">
        <ul class="list-group">
            @foreach($foods as $food)
                @if($food->discounts->isNotEmpty())
                    <li class="list-group-item mt-4">
                        <h4>Restaurant:{{$food->restaurant->name}}</h4>
                        <h4>Food:{{$food->name}}</h4>
                        <ul class="list-group mb-2">
                            @foreach($food->discounts as $discount)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold">Percent:</span> {{$discount->percent}}
                                            <span class="ms-3 fw-bold">Value:</span> {{$discount->value}}
                                        </div>
                                        <form action="/admin/discounts/{{$discount->id}}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endsection
