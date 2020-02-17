@extends('supplier.partials.loginapp')

@section('content')
    <div class="content pt-4 pb-5">
        <div class="container ">
            <h4 class="text-center pt-5">Sumed Supplier Registration Portal</h4><br>
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="login pt-5">
                        <h3 class="text-center pt-2 newText pb-3">Login</h3>
                        <h6 class="text-center newText">Sign in and start managing your activities</h6><br>
                        <div class="row mt-2">
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10 ml-4">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form class="formLogIn" method="POST" action="{{ route('supplier.login.submit') }}">
                                    @csrf
                                    <div class="form-group pb-2">
                                        <label>Username</label>
                                        <input type="text"  name="username" class="form-control" placeholder="Enter Your Username"
                                            aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <input type="password" id="passwordField" name="password" class="form-control password" id="passwordField" placeholder="Enter Your Password" aria-label="Username">
                                             <div class="input-group-prepend">
                                                <span class="input-group-text border-0"><a id="togglePasswordField" class="border-0 show"><i class="fa fa-eye-slash"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="check pt-1">Remember Me
                                        <input type="checkbox" name="remember" >
                                        <span class="checkmark"></span>
                                    </label><br>

                                    <p class="text-center mt-3"><a href="{{ URL::to('supplier/password/reset') }}" class="newText">Forget Your Password ?</a></p>
                                    <p class="text-center pt-1 pb-5"><button class="btn btnLogin font-weight-bold">Log in &nbsp;<img src="{{ asset('images/right.svg') }}"></button></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5">
                    <div class="logPhoto2 mt-2 pt-5">
                        <img src="{{ asset('images/logo.png') }}" class="imageLogin"><br>
                        <h3 class="text-center">Our Supplier Registration Portal enables us to communicate with our various suppliers worldwide.
                        </h3><br>
                        <p class="text-center">Create an account for your company & start the registration cycle to become one of our suppliers.</p>
                        <p class="text-center pt-1 pb-4"><a href="{{ URL::to('supplier/register') }}" class="btn py-2 btnLogin2 font-weight-bold">Create Account
                                &nbsp;<img src="{{ asset('images/right.svg') }}"></a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

