@extends('supplier.partials.loginapp')
    @push('css')
        <style>
            .usernameerror{
                font-size: 13px;
                color: red;
            }
        </style>
    @endpush
@section('content')
    <div class="content">
        <div class="container pt-4 pb-5">
            <h4 class="text-center pt-5">Sumed Supplier Registration Portal</h4><br>
            <div class="row mt-4">
                <div class="col-lg-7">
                    <div class="login pt-5">
                        <h4 class="text-center newText pt-4"> Create New Account </h4><br>
                        <div class="row mt-2">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-lg-1"></div>
                            <div class="col-lg-10 ml-4">
                                <input type="hidden" id="checkUnique" data-username="" data-email="" data-company_name="">
                                <form method="POST" action="{{ route('supplier.register.submit') }}" class="formRegistration">
                                    @csrf
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" id="username" value="{{ old('username') }}" pattern="[a-zA-Z0-9 ]+" name="username" class="form-control uniqueField " placeholder="Enter Your Username"
                                            aria-describedby="helpId">
                                            <span id="usernamespan" ></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" value="{{ old('email') }}" name="email" class="form-control uniqueField" placeholder="Enter Your Email"
                                            aria-describedby="helpId">
                                            <span id="emailspan" ></span>

                                    </div>
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" value="{{ old('company_name') }}" name="company_name" class="form-control uniqueField" placeholder="Enter Your Company Name"
                                            aria-describedby="helpId">
                                            <span id="company_namespan" ></span>

                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password" class="form-control password" id="passwordField" placeholder="Enter Your Password" aria-label="Username">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text border-0"><a id="togglePasswordField" class="border-0 show"><i class="fa fa-eye-slash"></i></a></span>
                                            </div>
                                        </div>
                                        <small><i>Must be at least 6 characters</i></small>
                                    </div>
                                    <h5>What is the nature of your company ? <small> ( Choose Up to 2 )</small>
                                    <span data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                    title="Classify your company type. You can choose two options"><i class="far fa-question-circle"></i></span></h5>
                                    <input name="type" id="type" type="hidden">
                                    <div class="row py-2">
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input id="select1" type-attr="supplier"  type="checkbox"  class="custom-control-input">
                                                <label class="custom-control-label" for="select1"><small>Service Provider / Contractor</small></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="custom-control custom-checkbox">
                                                <input id="select2" type-attr="vendor" type="checkbox" class="custom-control-input" >
                                                <label class="custom-control-label" for="select2"> <small>Vendor</small></label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="custom-control custom-checkbox">
                                                <input id="select3" type-attr="bidder" type="checkbox" class="custom-control-input" >
                                                <label class="custom-control-label" for="select3"> <small>Bidder</small></label>
                                            </div>
                                        </div>
                                    </div><br>

                                    <h5> Where is your company based? <span data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                    title="Specify where your company is located."><i class="far fa-question-circle"></i></span>
                                    </h5>

                                    <div class="row py-2">
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="custom-control custom-radio">
                                                <input id="selectService1" type-attr="supplier" value="1" type="radio" name="national" class="custom-control-input">
                                                <label class="custom-control-label" for="selectService1" style="cursor:pointer">International <small>(Headquarter Outside Egypt)</small></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="custom-control custom-radio">
                                                <input id="selectService2" type-attr="supplier" value="0"  type="radio" name="national" class="custom-control-input">
                                                <label class="custom-control-label" for="selectService2" style="cursor:pointer">Domestic <small>(Headquarter Inside Egypt)</small></label>
                                            </div>
                                        </div>
                                    </div><br>

                                    <div id="bus_type">
                                        <h5> How do you provide your services/products? <span data-toggle="tooltip"  data-placement="top"
                                        title="Services/Products could be provided through your Company and Agent. Also they could be provided through distributor"><i class="far fa-question-circle"></i></span></h5>
                                        <input name="business_type" id="product" type="hidden" value="company">
                                        <div class="row py-2 provideService">
                                            <div class="col-lg-4 col-sm-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input id="selectServiceProduct1" type="checkbox" data-type="company" class="custom-control-input">
                                                    <label class="custom-control-label" for="selectServiceProduct1">Through our company</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input id="selectServiceProduct2" type="checkbox" data-type="agent" class="custom-control-input" >
                                                    <label class="custom-control-label" for="selectServiceProduct2"> Through the Agent </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input id="selectServiceProduct3" type="checkbox" data-type="distributor" class="custom-control-input" >
                                                    <label class="custom-control-label" for="selectServiceProduct3"> Through Distributor </label>
                                                </div>
                                            </div>
                                        </div><br>
                                        <!-- <ul class="list-group list-group-horizontal border-0">
                                            <li id="selectServiceProduct1" class="list-group-item" data-type="company">Through our company</li>
                                            <li id="selectServiceProduct2" class="list-group-item" data-type="agent">Through the Agent</li>
                                            <li id="selectServiceProduct3" class="list-group-item" data-type="distributor">Distributor</li>
                                        </ul><br> -->
                                    </div>
                                    <div id="questionShow" style="display:none;" class="pb-3">
                                        <h5> Select, if you are an Agent / Distributor for another companies <span data-toggle="tooltip"  data-placement="top"
                                        title="Select, if you are an Agent / Distributor for another companies"><i class="far fa-question-circle"></i></span></h5>
                                        <input name="for_company" id="for_company" vlaue="" type="hidden">
                                        <div class="row py-2 provideService">
                                            <div class="col-lg-4 col-sm-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input id="forCompanyCheck1" type="checkbox" data-type="agent" class="custom-control-input">
                                                    <label class="custom-control-label" for="forCompanyCheck1">Agent</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input id="forCompanyCheck2" type="checkbox" data-type="distributor" class="custom-control-input" >
                                                    <label class="custom-control-label" for="forCompanyCheck2">Distributor</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <label class="check"><p> By creating an account, you agree to the Sumed <a href="#"> Terms of Service </a> and <a href="#"> Privacy Policy.</a></p>
                                        <input type="checkbox" name="terms_condition" id="terms_condition">
                                        <span class="checkmark"></span>
                                    </label><br>
                                    <p class="text-center pt-1"><button disabled class="btn btnLogin font-weight-bold" id="registerbtn">Create Account  <i class="ml-2 fa fa-angle-right"></i></button></p><br><br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="logPhoto pt-5">
                        <img src="{{ asset('images/logo.png') }}" class="d-flex mx-auto"><br>
                        <h3 class="text-center">Welcome back to Arab Petroleum Pipelines Co. SUMED.</h3><br>
                        <p class="text-center">Already have an account? Login now <br> to access your personal info</p>
                        <p class="text-center pt-2"><a href="{{ URL::to('supplier/login') }}" class="btn btnLogin2 py-2 font-weight-bold">Login <img src="{{ asset('images/right.svg') }}"></a></p><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div><br>


@endsection

@push('scripts')
    <script>
        $(document).on('change', '#terms_condition', function(){
            let checkuni = true;
            if($('#checkUnique').attr('data-username') || $('#checkUnique').attr('data-email') || $('#checkUnique').attr('data-company_name')){
                checkuni = false;
            }
            if($(this).prop("checked") == true && checkuni){
                $('#registerbtn').removeAttr("disabled")
            }
            else{
                $('#registerbtn').attr("disabled", true)

            }
        })

        $('#username').keypress(function (e) {
            var regex = new RegExp("[a-zA-Z0-9\s]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                $('#usernamespan').text('');
                $('#usernamespan').removeClass('usernameerror');

                return true;
            }
            else
            {
                e.preventDefault();
                $('#usernamespan').text('Invalid username. Usernames must start with a letter. Allowed characters (a-z) and numbers (0-9)');
                $('#usernamespan').addClass('usernameerror');
                return false;
            }
        });

        $('.uniqueField').change(function(e){
            let name =$(this).attr('name');
            let value =$(this).val();
            let that =$(this);
            $.get('{{ URL::to("supplier/checkField") }}/'+name+'/'+value,function(data){
                if(data=='Found'){
                    $('#checkUnique').attr('data-'+name, 'Found');
                    that.addClass('userTaken');
                    $('#'+name+'span').addClass('usernameerror');
                    $('#'+name+'span').text('Already Taken');
                }
                else{
                    that.removeClass('userTaken');
                    $('#'+name+'span').removeClass('usernameerror');
                    $('#'+name+'span').text('');
                    $('#checkUnique').attr('data-'+name, '')
                }

                let checkuni = true;
                if($('#checkUnique').attr('data-username') || $('#checkUnique').attr('data-email') || $('#checkUnique').attr('data-company_name')){
                    checkuni = false;
                }
                if($('#terms_condition').prop("checked") == true && checkuni){
                    $('#registerbtn').removeAttr("disabled")
                }
                else{
                    $('#registerbtn').attr("disabled", true)

                }
            })
            
        })
    </script>

    <script>
        let forCompanyCheck = evt4=>{
            $("#for_company").val('');
            if($('#forCompanyCheck1').prop("checked") == true &&  $('#forCompanyCheck2').prop("checked") == true){
                $("#for_company").val('both')
            }
            else if($('#forCompanyCheck1').prop("checked") == true){

                $("#for_company").val('agent')
            }
            else if($('#forCompanyCheck2').prop("checked") == true){

                $("#for_company").val('distributor')
            }
            else{
                $("#for_company").val('');

            }
           
        }
        $("#forCompanyCheck1").click(forCompanyCheck);
        $("#forCompanyCheck2").click(forCompanyCheck);
        let activateLink = evt=>{
            var numclass = $("#type").val().split(',').length;
            console.log(numclass)
            if(numclass == 2){
                if($(evt.target).prop("checked") == true ){
                    $( ".bidder" ).each(function( index ) {
                        $( this ).prop('checked', false) ;
                        $( this ).removeClass('bidder') ;
                    });
                    $(evt.target).addClass('bidder');
                    $("#type").val($(evt.target).attr('type-attr'));
                }
                else{
                    $(evt.target).removeClass('bidder');
                    $("#type").val($('.bidder').first().attr('type-attr'));

                }

            }
            else{

                if($(evt.target).prop("checked") == true ){
                    $(evt.target).addClass('bidder');
                    if($("#type").val()){
                        $("#type").val($(evt.target).attr('type-attr')+ ','+$("#type").val());
                    }
                    else{
                        $("#type").val($(evt.target).attr('type-attr'));
                    }
                }
                else{
                    $(evt.target).removeClass('bidder');
                    $("#type").val($('.bidder').first().attr('type-attr'));
                }



            }

        }
        $("#select1").click(activateLink);
        $("#select2").click(activateLink);
        $("#select3").click(activateLink);

        // let activateLink2 = evt2=>{
        //     // console.log($(evt2.target).is("small"));
        //     $(".bg-dangerr").removeClass("bg-dangerr");
        //     let item;
        //     if ($(evt2.target).is("small")) item = $(evt2.target).parent();
        //     else item = $(evt2.target);
        //     item.addClass("bg-dangerr");
        //     $("#bassed").val(item.attr('nation-attr'));
        //     // if(item.attr('nation-attr') == 1)
        //     //     $('#bus_type').show();
        //     // else
        //     //     $('#bus_type').hide();

        // }

        let activateLink3 = evt3=>{
            if($(evt3.target).attr('data-type') == 'company'){
                if($(evt3.target).prop("checked") == false ){
                    $('#questionShow').css('display', 'none');
                    $("#for_company").val('');

                }
                else{
                    $('#questionShow').css('display', 'block');

                }

            }
            else if($(evt3.target).attr('data-type') == 'distributor'){
                $('#questionShow').css('display', 'none');
                $("#for_company").val('');

            }
            
            if($(evt3.target).attr('data-type') == 'distributor'){
                if($(evt3.target).prop("checked") == false ){
                    $(evt3.target).prop('checked', false);
                    $(evt3.target).removeClass('companyType');

                }
               else{
                    $( ".companyType" ).each(function( index ) {
                        $( this ).prop('checked', false) ;
                        $( this ).removeClass('companyType') ;
                    });

                    $(evt3.target).prop('checked', true);
                    $(evt3.target).addClass('companyType');

                    $("#product").val($(evt3.target).attr('data-type'));
                }
            }
            else{
                $('#selectServiceProduct3').prop('checked', false);
                $('#selectServiceProduct3').removeClass('companyType');
                // $(evt3.target).removeClass('companyType');

                if($(evt3.target).prop("checked") == false){
                    $(evt3.target).prop('checked', false);
                    $(evt3.target).removeClass('companyType');


                }
                else{
                    $(evt3.target).prop('checked', true);
                    $(evt3.target).addClass('companyType');
                }

                var numclass = $('.companyType').length
                if(numclass == 1){
                    $("#product").val($('.companyType').first().attr('data-type'));
                }
                else{
                    $("#product").val('both');
                }
            }
        }
        $("#selectServiceProduct1").click(activateLink3);
        $("#selectServiceProduct2").click(activateLink3);
        $("#selectServiceProduct3").click(activateLink3);
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        })
    </script>

@endpush
