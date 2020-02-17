@extends('supplier.partials.loginapp')

@section('content')
    <div class="forgetPassword pb-5">
        <div class="container pt-4">
            <h4 class="text-center pt-4 pb-4">Sumed Supplier Registration Portal</h4><br>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="forgetSection">
                        <h3 class="text-center newText mt-5">Forget Your Password</h3><br>
                        <p class="text-center newText">Enter your email address or  to receive <br> your password reset
                            instructions.</p><br>
                        <div class="row">
                            <div class="col-lg-3 col-1"></div>
                            <div class="col-lg-6 col-10">
                            <form id="resetpasswordForm" class="mt-2 pt-2 pb-4" action="{{ URL::to('supplier/password/email') }}" method="POST">
                                @csrf
                                    <label>Email Address </label>
                                    <input type="text" id="emailinput" class="form-control border-0" name="email"
                                        placeholder="Enter your Email Address">
                                    <small class="forgetEmail d-none" id="errorMessage"></small>
                                    <p class="text-center mt-5"><button type="submit"
                                            class="btn btnForget font-weight-bold px-5 py-2">Send</button></p>
                                </form>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>

                    </div><br>
                </div>
                <div class="col-lg-2"></div>
            </div>

        </div>
    </div>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script>

        $('#resetpasswordForm')
            .ajaxForm({
                url : $('#bankform').attr('action'), // or whatever
                type : $('#bankform').attr('method'), // or whatever
                dataType : 'json',
                success : function (response) {
                    if(response.success){
                        $('#emailinput').removeClass('inputFieldStyle');
                        window.location.href = '/supplier/password/emailsend';
                    }
                    else{
                        $('#emailinput').addClass('inputFieldStyle');
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text('There is no account associated with '+ $('#emailinput').val());
                    }
                },
                error: function (response){
                    console.log(response.responseJSON.errors)
                }
            });
    </script>
@endsection


