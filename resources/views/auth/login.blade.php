<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <title>Log in</title>
    </head>
    <body>
        <!-- Header -->
        <header class="pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-8 col-8">
                        <img src="{{ asset('images/sumed.png') }}">
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-4 col-4 text-right pt-2">
                        <select class="p-1 border-0">
                            <option value=""><a href="#" class="font-weight-bold">العربية</a></option>
                            <option value=""><a href="#" class="font-weight-bold">English</a></option>
                        </select>

                    </div>
                </div>
            </div>
        </header><br><br>
        <!-- End of Header -->
        <!-- Content -->
        <div class="content">
            <div class="container">
                <h4 class="text-center pt-4">Sumed Supplier Registration Portal</h4><br><br><br>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="login"><br>
                            <h3 class="text-center">Login</h3><br>
                            <h6 class="text-center font-weight-bold">Sign in and start managing your activities</h6><br>
                            <div class="row">
                                <div class="col-lg-1"></div>
                                <div class="col-lg-10 ml-4">
                                    <form class="formLogIn">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" name="" class="form-control" placeholder="Enter Your Username"
                                                aria-describedby="helpId">
                                        </div><br>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control password" id="passwordField" placeholder="Username" aria-label="Username">
                                                 <div class="input-group-prepend">
                                                    <span class="input-group-text"><a id="togglePasswordField" onclick="togglePasswordFieldClicked()" class="border-0 show"><i class="fa fa-eye-slash"></i></a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="check">Remember Me
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>

                                        <p class="text-center"><a href="#" class="forget">Forget Your Password ?</a></p>
                                        <p class="text-center pt-2"><button class="btn btnLogin font-weight-bold">Log in &nbsp;<i class="fa fa-angle-right"></i></button></p><br><br>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="logPhoto"><br><br>
                            <img src="{{ asset('images/Group14.png') }}"><br>
                            <h3 class="text-center">Now you can register your business online. It’s safe and fast system.</h3><br>
                            <p class="text-center">Don't have an account? Create one now and <br> submit your documents later</p>
                            <p class="text-center pt-2"><button class="btn btnLogin2 font-weight-bold">Create Account &nbsp; <i class="fa fa-angle-right"></i></button></p><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br><br>
        <!-- End of content -->
        <!-- Footer -->
        <footer class="text-center text-white pt-4 pb-3">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                <li class="list-inline-item"><i class="fa fa-circle fa-xs"></i></li>
                <li class="list-inline-item"><a href="#">Terms and Conditions</a></li>
                <li class="list-inline-item"><i class="fa fa-circle fa-xs"></i></li>
                <li class="list-inline-item"><a href="#">Contact Us</a></li>
            </ul>
        </footer>
        <!-- End Of Footer -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/file.js') }}"></script>
    </body>
</html>
