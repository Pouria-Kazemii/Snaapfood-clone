@extends('layouts.auth')

@section('content')
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100 ">
            <div class="row d-flex justify-content-center align-items-center ">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class=" bg-danger bg-gradient text-light" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center ">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">REGISTER</h2>
                                <p class="text-white-50 mb-5">Please enter your information!</p>
                                <form action="/register" method="POST">
                                    @csrf
                                    <div class="form-outline form-white mb-4 ">
                                        <input type="text" name="name"  class="form-control form-control-lg" />
                                        <label class="form-label" >Name</label>
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="tel" name="phone"  class="form-control form-control-lg" />
                                        <label class="form-label" >Phone Number</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="email" name="email"  class="form-control form-control-lg" />
                                        <label class="form-label" >Email</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="password"  class="form-control form-control-lg" />
                                        <label class="form-label" >Password</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="password_confirmation"  class="form-control form-control-lg" />
                                        <label class="form-label" >Password Confirm</label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input class="form-check-input" type="radio" name="role" value="customer" >
                                        <label class="form-check-label">
                                            Customer
                                        </label>
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <input class="form-check-input" type="radio" name="role" value="restaurant">
                                        <label class="form-check-label">
                                            Restaurant
                                        </label>
                                    </div>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">register</button>
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

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

