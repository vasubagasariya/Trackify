@extends('layout.main')
@section('title', 'Login')
@section('main')

<!-- Full screen container for centering -->
<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="row d-flex justify-content-center align-items-center w-80">
        <!-- Image column -->
        <div class="col-md-9 col-lg-6 col-xl-5 d-flex justify-content-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                 class="img-fluid" alt="Sample image">
        </div>

        <!-- Form column -->
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form method="post" action="{{route('login.check')}}">
                @csrf
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="form3Example3" name="username" class="form-control form-control-lg"
                           placeholder="Enter Username" />
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-3">
                    <input type="password" id="form3Example4" name="password" class="form-control form-control-lg"
                           placeholder="Enter password" />
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check mb-0">
                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                        <label class="form-check-label" for="form2Example3">
                            Remember me
                        </label>
                    </div>
                    <a href="#!" class="text-white">Forgot password?</a>
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                    <input type="submit" data-mdb-button-init data-mdb-ripple-init
                            class="btn btn-primary btn-lg"
                            value="Login"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
