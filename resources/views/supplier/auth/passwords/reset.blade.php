@extends('supplier.partials.loginapp')

@section('content')
    <div class="pb-5 pt-4 resetSection">

        <div class="container">

            <h4 class="text-center pb-4 pt-4">Sumed Supplier Registration Portal</h4><br>
            
            <div class="row">
                <div class="col-2"></div>

                <div class="col-lg-8">

                    <div class="resetPassword">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h3 class="text-center newText font-weight-bold mt-5">Reset Password</h3><br>
                        <p class="text-center newText">Enter a new password, then your password <br> will be changing.</p><br>
                        <div class="row">
                            
                            <div class="col-2"></div>
                            <div class="col-lg-7">
                                <form class="ml-5 mt-2 pb-5" action="{{ URL::to('supplier/password/reset') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="confirmcode" value="{{ $token }}">
                                    <div class="form-group pb-3">
                                        <label class="font-weight-bold">New Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control password" id="passwordField" placeholder="Enter Your Password" aria-label="Username">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-0"><a onclick="showpassword(this)" class="border-0 show"><i class="fa fa-eye-slash"></i></a></span>
                                            </div>
                                        </div>
                                        <small><i>Must be at least 6 characters </i></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-bold">Confirm Your Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" class="form-control password" id="passwordField2"  placeholder="Enter Your Password"  aria-label="Username">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-0"><a onclick="showconfirmpassword(this)" class="border-0 show"><i class="fa fa-eye-slash"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-center mt-5"><button class="btn px-5 btnLogin font-weight-bold">Set Password <img src="{{ asset('images/right.svg') }}" class="pl-2"></button></p> 
                                </form>
                            </div>
                        </div>
                        
                    </div><br>
                    
                </div>
            </div>
            
        </div>
    </div>
    <script>
        function showpassword(el){
            var passwordField = document.getElementById('passwordField');
            if(passwordField.type == 'password') {
                passwordField.type = 'text';
                $(el).html('<i class="fa fa-eye"></i>')
            }
            else {
                passwordField.type = 'password';
                $(el).html('<i class="fa fa-eye-slash"></i>')
            }
        }
        function showconfirmpassword(el){
            var passwordField = document.getElementById('passwordField2');
            if(passwordField.type == 'password') {
                passwordField.type = 'text';
                $(el).html('<i class="fa fa-eye"></i>')

            }
            else {
                passwordField.type = 'password';
                $(el).html('<i class="fa fa-eye-slash"></i>')

            }
        }


    </script>
@endsection


