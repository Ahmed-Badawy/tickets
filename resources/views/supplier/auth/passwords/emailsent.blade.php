@extends('supplier.partials.loginapp')

@section('content')
    <div class="forgetPassword pb-5">
        <div class="container pt-4">
            <h4 class="text-center pt-4 pb-4">Sumed Supplier Registration Portal</h4><br>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="forgetSection">
                        <h2 class="text-center newText mt-5">Email Sent Successfully</h2><br>
                        
                        <div class="row pb-4">
                            <div class="col-lg-2 col-1"></div>
                            <div class="col-lg-8 col-10">
                                <img src="{{ asset('images/emailSuccess.svg') }}" class="d-flex mx-auto">
                                <p class="text-center pt-4">
                                    Please check your inbox, we sent you link to reset your password.
                                </p>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                    </div><br>
                </div>
                <div class="col-lg-2"></div>
            </div>

        </div>
    </div>
@endsection


