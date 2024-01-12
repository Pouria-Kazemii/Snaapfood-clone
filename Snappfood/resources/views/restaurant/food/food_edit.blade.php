@extends('Layouts.restaurant');

@section('content')

    @if($errors->any())
        <div class="alert alert-danger text-center">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li class="text-warning">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($food and !$food->is_deleted)
        @if($food->restaurant_id == $restaurant->id)
    <form action="/restaurant/{{$restaurant->name}}/foods/{{$food->id}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">food name</label>
            <input type="text" class="form-control" name="name" value="{{$food->name}}">
        </div>
        <div class="mb-3">
            <label class="form-label">price</label>
            <input type="text" class="form-control" name="price" value="{{$food->price}}">
        </div>
        <div class="mb-3">
            <label class="form-label">raw materials</label>
            <textarea class="form-control" name="raw_material">{{$food->raw_material}}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mt-3">
            <select class="form-select" name="type_of_food">
                @foreach($typeOfFoods as $typeOfFood)
                    <option value="{{$typeOfFood->type}}">{{$typeOfFood->type}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        @else
            <h2>this food not belongs to your restaurant</h2>
        @endif
    @else
        <h3>This food not exist</h3>
    @endif
@endsection

