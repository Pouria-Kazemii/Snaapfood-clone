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

        <form action="/restaurant/{{$restaurant->name}}/settings/update_status" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label class="form-label mt-4">Your Restaurant Is Now <strong>{{ $restaurant->is_open }}</strong></label>
            </div>
            <button type="submit" class="btn btn-warning mb-4">Change it</button>
        </form>

        <div class="btn-group" role="group" aria-label="Settings Navigation">
            <a href="/restaurant/{{$restaurant->name}}/settings/working_hours" class="btn btn-warning text-white">Working Hours</a>
            <a href="/restaurant/{{$restaurant->name}}/settings/type_of_restaurant" class="btn btn-warning text-white">Type Of Restaurant</a>
        </div>

            <h3 class="mt-4">Your Restaurant Working Hours</h3>

            @foreach($restaurant->restaurantHoures as $restaurantHour)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$restaurantHour->day}}</h5>
                        <p class="card-text">Status: {{$restaurantHour->is_open}}</p>

                        @if($restaurantHour->is_open == 'open')
                            <p class="card-text">Opening Time: {{ \Carbon\Carbon::parse($restaurantHour->opening_time)->format('H:i') }}</p>
                            <p class="card-text">Closing Time: {{ \Carbon\Carbon::parse($restaurantHour->opening_time)->format('H:i') }}</p>
                        @endif
                    </div>
                </div>
            @endforeach


        <form action="/restaurant/{{$restaurant->name}}/settings/update_restaurant" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <h3>Your Restaurant Specifications</h3>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ $restaurant->name }}">
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Telephone Number</label>
                <input id="phone_number" name="phone_number" type="number" class="form-control" value="{{ $restaurant->phone_number }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control">{{$restaurant->address}}</textarea>
            </div>

            <div class="mb-3">
                <label for="account_number" class="form-label">Account Number</label>
                <input id="account_number" name="account_number" type="number" class="form-control" value="{{ $restaurant->account_number }}">
            </div>

            <div class="mb-3">
                <label for="sending_price" class="form-label">Sending Price</label>
                <input id="sending_price" name="sending_price" type="number" class="form-control" value="{{ $restaurant->sending_price }}">
            </div>

            <div class="mb-3">
                <img style="height: 400px;width:100%" class="img-fluid" src="{{ Storage::url("public/pictures/banners/$restaurant->banner_image_path") }}">
                <label for="banner" class="form-label">Change Banner For Your Restaurant</label>
                <input id="banner" type="file" name="banner" class="form-control">
            </div>

            <div class="mb-3">
                <img style="height: 400px;width:100%" class="img-fluid" src="{{ Storage::url("public/pictures/profile/$restaurant->profile_image_path") }}">
                <label for="profile" class="form-label">Change Profile Image For Your Restaurant</label>
                <input id="profile" type="file" name="profile" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection
