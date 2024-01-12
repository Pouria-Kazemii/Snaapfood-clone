@extends('layouts.restaurant')

@section('content')
    <div class="container mt-4">
        @if($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li class="text-warning">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/restaurant/{{ $restaurant->name }}/foods" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Food Name</label>
                <input type="text" class="form-control" id="name" name="name" >
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" >
            </div>

            <div class="mb-3">
                <label for="raw_material" class="form-label">Raw Materials</label>
                <textarea class="form-control" id="raw_material" name="raw_material" ></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image" >
            </div>

            <div class="mt-3">
                <label for="type_of_food" class="form-label">Type of Food</label>
                <select class="form-select" id="type_of_food" name="type_of_food" >
                    @foreach($typeOfFoods as $typeOfFood)
                        <option value="{{ $typeOfFood->type }}">{{ $typeOfFood->type }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection

