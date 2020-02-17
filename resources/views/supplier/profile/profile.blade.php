@extends('supplier.partials.app')

@section('content')
    <div class="details mt-5">
        <div class="container">
            <div class="tabButton" id="tabs">
                <ul class="nav nav-pills text-white bg-dark flex-column flex-md-row nav-justified">
                    <li class="nav-item border-right"><a class="nav-link active" data-toggle="pill" href="#companyDetailsShow"> {{ $user->business_type=='distributor' ? 'Distributor':'Company' }} Details</a></li>
                    <li class="nav-item border-right"><a class="nav-link" data-toggle="pill" href="#companyBranches"> Branches </a></li>
                    <li class="nav-item border-right"><a class="nav-link" data-toggle="pill" href="#bankAccountDetails">Bank Account</a></li>
                    <li class="nav-item border-right"><a class="nav-link" data-toggle="pill" href="#showActivities">Activities</a></li>
                    <li class="nav-item border-right"><a class="nav-link" data-toggle="pill" href="#uploadDocuments">Upload Documents</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#submitDataShow">Submit Your Data </a></li>
                </ul>
            </div>
            <div class="tab-content">

                @include('supplier.profile.company')

                @include('supplier.profile.branches')
                
                @include('supplier.profile.banks')
                
                @include('supplier.profile.activities')

                @include('supplier.profile.documents')



                <div id="submitDataShow" class="tab-pane">

                    @if(count($user->checknewactivity))
                        <div class="submitData mt-5 pt-5 pb-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-lg-10">
                                        <p class="text-left" style="font-weight:500">Check all your data again and make sure it's all correct. After submitting, you won't be able to change any data til you get a response from us.
                                        </p><br>
                                        <p class="text-left">By entering authentication information, you are submitted to Arab Petroleum Pipelines Co. SUMED information system. This system is for the use of authorized users only.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container pt-4 ">
                            <p class="text-center"><a href="{{ URL::to('supplier/submit') }}" class="btn btnSubmitDataSuccess">Submit Your Account</a></p>
                        </div>
                    @elseif($user->status == 3)
                        <div class="submitDataShow bg-white pt-5 mt-5 pb-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-lg-10">
                                        <p class="newText font-weight-bold">
                                            Please note that submission will be available when you add a new activity only, any changes in your details will not be count.
                                        </p><br>
                                        <p class="text-left">
                                            By entering authentication information, you are submitted to Arab Petroleum Pipelines Co. SUMED information system. This system is for the use of authorized users only.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white mt-5 pt-5 pb-5 submitDataShow">
                            <div class="container">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-lg-10">
                                        <p class="newText font-weight-bold">
                                            Your data has been submitted successfully.
                                        </p><br>
                                        <h5 class="text-left">
                                            Please note that you can’t edit any changes to your account till you got a response,
                                            for any further assistance, kindly <a href="{{ URL::to('supplier/contactus') }}" class="contactText">Contact Us</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="submitDataShow bg-white pt-5 mt-5 pb-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-lg-10">
                                        <p class="newText font-weight-bold">
                                            Please note that submission will be available when you add a new activity only, any changes in your details will not be count.
                                        </p><br>
                                        <p class="text-left">
                                            By entering authentication information, you are submitted to Arab Petroleum Pipelines Co. SUMED information system. This system is for the use of authorized users only.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

