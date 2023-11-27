@extends('layouts.admin')
@section('content')
    <div class="container mt-4">
        <h2 class="text-center mt-3">FOOD TYPES:</h2>
    </div>

    @if($errors)
        <div class="mt-4 text-left">
            @foreach($errors->all() as $error)
                <li class="text-warning">
                    {{$error}}
                </li>
            @endforeach
        </div>
    @endif
    @foreach($types as $type)
    <div class="container mt-4">
        <div class="row">
                <h2>{{$type->type}}</h2>
            </div>

            <div class="col-md-6 text-end">
                <form action="/admin/food_types/{{$type->id}}" method="POST">
                    @method('delete')
                    @csrf
                    <button class="btn btn-danger">Delete</button>
                </form>
                <form action="/admin/food_types/{{$type->id}}" method="POST">
                    @method('PUT')
                    @csrf
                    <input type="text" name="type">
                    <button type="submit" class=" mb-3 btn-sm btn btn-danger btn-link text-decoration-none text-white ms-2 mt-2">Edit</button>
                </form>
            </div>
        @endforeach
        <div class="col-md-6">
            <div class="col-12 mt-3">
                <form action="/admin/food_types" method="POST">
                    @csrf
                    <input  type="text" name="type">
                    <button  class="mb-1 btn btn-danger btn-sm btn-link text-decoration-none text-white">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection
