@extends('layouts.auth')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-danger bg-gradient text-light" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                <form action="/login" method="POST">
                                    @csrf
                                    <div class="form-outline form-white mb-4">
                                        <input type="email" name="email" id="typeEmailX" class="form-control form-control-lg" />
                                        <label class="form-label" for="typeEmailX">Email</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="password" id="typePasswordX" class="form-control form-control-lg" />
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                </form>


                                @if($errors)
                                    <div class="mt-4 text-center">
                                        @foreach($errors->all() as $error)
                                            <li class="text-warning">
                                                {{$error}}
                                            </li>
                                        @endforeach
                                    </div>
                                @endif



                                <p class="small mb-5 mt-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                                <div>
                                    <p class="mb-0">Don't have an account? <a href="/register" class="text-white-50 fw-bold">Register</a>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
