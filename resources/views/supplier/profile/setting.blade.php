@extends('supplier.partials.app')

@section('content')
<div class="container"><br>
    <h3 class="text-left font-weight-bold" >Account Setting</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @elseif(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    <form action="{{ URL::to('supplier/updateprofile') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionEx" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card border-0 firstUploadCollapse">

                <!-- Card header -->
                <div class="card-header bg-white p-3" role="tab">
                    <a data-toggle="collapse" data-parent="#accordionEx" href=".collapseDetails1" aria-expanded="true"
                        aria-controls="collapseDetails1">
                        <h5 class="mb-2 border-0">
                            Basic Infomation
                            <i class="float-right fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div class="collapse show borderd border-top-0 collapseDetails1" role="tabpanel" aria-labelledby="headingOne1"
                    data-parent="#accordionEx">
                    <div class="card-body">
                        <div class="addDetails p-2">
                            <div class="container">

                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="form-group">
                                            <label>Username</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                        <i class="far fa-question-circle"></i></span>
                                            <input type="text" disabled value="{{ $user->username }}" name="username" class="form-control" placeholder="Username"
                                                aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="form-group">
                                            <label>Email Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                        <i class="far fa-question-circle"></i></span>
                                            <input type="email" disabled value="{{ $user->email }}" name="email" class="form-control" placeholder="khaled.haasan@gmail.com"
                                                aria-describedby="helpId">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="form-group">
                                            <label>Company Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                        <i class="far fa-question-circle"></i></span>
                                            <input type="text" disabled value="{{ $user->company_name }}" name="company_name" class="form-control" placeholder="ADONC"
                                                aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="form-group">
                                            <label>Change Language</label>
                                            <select name="lang" class="form-control">
                                                <option value="en" {{ ($user->lang== 'en') ? 'selected':'' }}>English</option>
                                                <option value="ar" {{ ($user->lang== 'ar') ? 'selected':'' }}>Arabic</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Accordion card -->
        </div>

        <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionEx2" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card border-0 firstUploadCollapse">

                <!-- Card header -->
                <div class="card-header bg-white p-3" role="tab">
                    <a data-toggle="collapse" data-parent="#accordionEx2" href=".collapseDetails2" aria-expanded="true"
                        aria-controls="collapseDetails2">
                        <h5 class="mb-2 border-0">
                            Password
                            <i class="float-right fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div class="collapse show borderd border-top-0 collapseDetails2" role="tabpanel" aria-labelledby="headingOne1"
                    data-parent="#accordionEx2">
                    <div class="card-body">
                        <div class="addDetails p-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <label>Current Password</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer"
                                        data-placement="top" title="Type your current password"> <i class="far fa-question-circle"></i></span>
                                        <div class="input-group">
                                            <input type="password" name="current_password" class="form-control passwordField" placeholder="Current Password"
                                                aria-describedby="helpId">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-0"><a class="border-0 show togglePasswordField"><i class="fa fa-eye-slash"></i></a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row pt-4">
                                    <div class="col-1"></div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="form-group">
                                            <label>New Password</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title=" Enter Your new password">
                                            <i class="far fa-question-circle"></i></span>
                                            <div class="input-group">
                                                <input type="password" name="new_password" class="form-control passwordField" placeholder="New Password" aria-describedby="helpId">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-0"><a class="border-0 show togglePasswordField"><i class="fa fa-eye-slash"></i></a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5">
                                        <div class="form-group">
                                            <label>Confirm New Password</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Confirm Your New Password">
                                            <i class="far fa-question-circle"></i></span>
                                            <div class="input-group">
                                                <input type="password" name="confirm_password" class="form-control passwordField" placeholder="Confirm New Password"
                                                    aria-describedby="helpId">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-0"><a class="border-0 show togglePasswordField"><i class="fa fa-eye-slash"></i></a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Accordion card -->
        </div>
        <p class="text-center mt-3 pt-2"><button class="btn btnSaveChanges font-weight-bold">Save Changes </button></p>
    </form>
</div><br><script>
    $(document).on('click', '.togglePasswordField', function(){
        let pass= $(this).parent().parent().prev();
        pass.attr('type', pass.attr('type') == 'text' ? 'password' : 'text');
        var type = pass.attr('type');
        type == 'password' ?
                            $(this).html('<i class="fa fa-eye-slash"></i>'):
                            $(this).html('<i class="fa fa-eye"></i>');
    })
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
@endsection

