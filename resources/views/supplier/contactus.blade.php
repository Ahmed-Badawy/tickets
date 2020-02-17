@extends('supplier.partials.loginapp')

@section('content')

    <div class="container pb-5">
        <h3 class="text-center mt-5 mb-4 textContactUs">Contact Us</h3>
        <form action="{{ URL::to('supplier/contactus') }}" method="POST">
            @csrf
            <div class="contactUs bg-white p-5 mt-4 mb-5">
                <div class="row">


                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success')[0] !!}</li>
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Email Address</label>
                            <input name="email" required type="email" class="form-control" placeholder="Enter Your Email"
                                aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" required class="form-control" placeholder="Add Your Subject"
                                aria-describedby="helpId">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" name="message" required placeholder="Add Your Message" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center"><button class="btn btnSubmit font-weight-bold">Send Message</button></p>
        </form>
    </div>
@endsection
