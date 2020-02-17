@extends('supplier.partials.app')

@section('content')
    <div class="p-2" id="successForm">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="successfulSubmit p-4 text-center">
                        <img src="{{ asset('images/close.svg') }}" alt="close" id="close" class="float-right"><br>
                        <p class="text-center mt-2"><img src="{{ asset('images/error(1).svg') }}"></p>
                        <h2 class="mt-5">Your Request Can’t Be Submitted</h2>
                        <p class="mt-4">Please fill all the required fields and upload all the documents in PDF extension before submission.</p>
                        <p class="mt-4 mb-5">
                            <button class="btn btnSubmit">Back to Account Details</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function(){
           window.location.href = '{{ URL::to("supplier/details") }}';
        }, 5000);
    </script>
@endsection
