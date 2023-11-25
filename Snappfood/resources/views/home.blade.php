@extends('layouts.auth')

@section('content')
    <section class="container">
        <div class="m-5 py-4 bg-secondary">
            <h2 class=" text-center fs-1 mt-2 text-danger">Welcome to the snappfood</h2>
            <p class="text-warning fs-3 mt-5 ">In the bustling world of culinary exploration, our online platform stands as a gateway to a diverse gastronomic journey. With an array of restaurants at your fingertips, our platform connects food enthusiasts to a rich tapestry of flavors. From local gems to internationally inspired cuisines, our curated selection of restaurants caters to every palate. Seamlessly blending convenience with culinary excellence, our platform invites you to savor the extraordinary from the comfort of your own home.</p>
        </div>

        <div class="d-flex justify-content-between mx-auto pt-5 " style="width: 500px">
            <button class="btn btn-lg btn-danger" style="width: 200px">
                <a href="/login" class="text-warning">Login</a>
            </button>
            <button class="btn btn-lg btn-danger" style="width: 200px ">
                <a href="/register" class="text-warning">Register</a>
            </button>
        </div>
    </section>
@endsection

