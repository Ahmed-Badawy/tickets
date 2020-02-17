@extends('supplier.partials.app')

@section('content')
    <div class="p-2" id="successForm">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="successfulSubmit p-4 text-center">
                        <a href="{{ URL::to('supplier') }}"><img src="{{ asset('images/close.svg') }}" alt="close" id="close" class="float-right"></a><br>
                        <p class="text-center mt-2"><img src="{{ asset('images/check-circle-outline.svg') }}"></p>
                        <h2 class="mt-5">Your data has been submitted successfully</h2>
                        <p class="mt-4">You will receive a notification when the status of your account changes.</p>
                        <p class="mt-4 mb-5">Please note that any changes to your submitted data might cause delays.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // setTimeout(function(){
        //    window.location.href = '{{ URL::to("supplier/details") }}';
        // }, 5000);
    </script>
@endsection
