@extends('supplier.partials.loginapp')

@section('content')

<div class=" mb-5">
    <div class="container">
        <h3 class="text-center emailSendText mb-4 pt-5">Sumed Supplier Registration Portal</h3><br>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-lg-8">
                <div class="emailVerificate">
                    <h3 class="text-center mt-5">Email Verification</h3><br>
                    <p class="text-center font-weight-bold">Please check your email address, we sent you a confirmation <br> link to verify your account.</p><br>
                    <img src="{{ asset('images/email.svg') }}"><br>
                    <p class="text-center" style="font-size:13px"><a class="text-dark">Didn't receive it?</a></p>
                    <p class="text-center"><a href="{{ URL::to('supplier/resendverifyemail') }}" class="btn btnEmail">Resend Verification Link</a></p>
                    <p class="text-center"><a href="{{ URL::to('supplier') }}" class="btn btnEmail bg-white border-info">Contine to Home Page</a></p>
                </div><br>
            </div>
        </div>

    </div>
</div>

@endsection
