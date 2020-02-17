    <div id="submitData" class="tab-pane">
        @if (count($user->checknewactivity))
            <div class="submitData mt-5 pt-5 pb-5 bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-lg-10">
                            <p class="text-left reviewText" style="font-weight:500">Please review your data before submission. After submission you will not be able to edit any of the entered details until approval from Sumed team.
                            </p><br>
                            <p class="text-left">By entering authentication information, you are submitted to Arab Petroleum Pipelines Co. SUMED information system. This system is for the use of authorized users only.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container p-0 pt-4 d-none" id="errorDiv" >
                <div class="reject p-4">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10">
                            <div >
                                <img class="float-left pr-2" src="{{ asset('images/rejects.svg') }}">
                                <h5 class="text-danger pt-1">Missing Data</h5>
                                <p class="font-weight-bold reviewText pt-3">Please fill out all the required fields in order to submit your data. Here are what is missing:</p>
                                <div id="errorList">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pt-4 d-none" id="FailBtn">
                <p class="text-center"><button class="btn btnSubmitDataFaill" disabled> Submit </button></p>
            </div>
            <div class="container pt-4 d-none" id="SuccessBtn">
                <p class="text-center"><a href="{{ URL::to('supplier/submit') }}" class="btn btnSubmitDataSuccess"> Submit </a></p>
            </div>
        @else
            <div class="submitData mt-5 pt-5 pb-5 bg-white">
                <div class="container">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-lg-10">
                            <p class="text-left" style="font-weight:500">Please note that submission will be available when you add a new activity only, any changes in your details will not be count.
                            </p><br>
                            <p class="text-left">By entering authentication information, you are submitted to Arab Petroleum Pipelines Co. SUMED information system. This system is for the use of authorized users only.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container pt-4" >
                <p class="text-center"><button class="btn btnSubmitDataFaill" disabled> Submit </button></p>
            </div>

        @endif
    </div>
    <script></script>

    @push('scripts')
        <script>
            $('#submitCheckTab').click(function(){
                $('.documentsclass').removeClass('borderUpload');
                $.get('{{ URL::to("supplier/checkdata") }}', function(data){
                    if(data.success === 'Error'){
                        $('#errorDiv').removeClass('d-none');
                        $('#errorList').html('');
                        $('.form-control').removeClass('inputFieldStyle');
                        for(var i=0; i< data.taps.length; i++){
                            $('#errorList').append('<p>'+(i+1)+' - '+data.taps[i].name);
                            if(data.taps[i].name == 'Company Details (Basic Information)'){
                                $.each(data.taps[i].cols, function (key, value) {
                                    var input = $('#companyForm').find('input[name=' + value + ']');
                                    console.log(input)
                                    $(input).addClass('inputFieldStyle');
                                    $(input).next().css('display','block');
                                });
                            }
                            if(data.taps[i].name == 'Upload Documents (Required Documents)'){
                                $.each(data.taps[i].cols, function (key, value) {
                                    $('#doucumentnum_'+value).addClass('borderUpload');
                                });
                            }
                        }
                        $('#FailBtn').removeClass('d-none');
                        $('#SuccessBtn').addClass('d-none');
                    }
                    else{
                        $('#FailBtn').addClass('d-none');
                        $('#errorDiv').addClass('d-none');
                        $('#SuccessBtn').removeClass('d-none');
                    }
                })
            });
        </script>
    @endpush
