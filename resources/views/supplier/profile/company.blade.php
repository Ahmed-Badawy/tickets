<div id="companyDetailsShow" class="tab-pane p-0  container fade active show">
    <div class="companyDetailHide">
        <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionEx" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card border-0 firstUploadCollapse">

                <!-- Card header -->
                <div class="card-header bg-white py-3 pl-0" role="tab">
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
                        <div class="contanier">
                            <div class="addDetails p-2">
                                <div class="container">
                                <div class="row">

                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="compAdd">
                                            <label>Company Address</label>
                                            <p class="mt-1">{{ $user->address }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="compAdd">
                                            <label>Commercial Name</label>
                                            <p class="mt-1">{{ $user->commercial_name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="compAdd">
                                            <label>Country</label>
                                            <p class="mt-1">{{ $user->country->name ??'----' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="compAdd">
                                            <label>City</label>
                                            <p class="mt-1">{{ $user->city->name ??'----' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="compAdd">
                                            <label>Phone Number</label>
                                            <p class="mt-1">+{{ $user->phone_code }} {{ $user->phone??'----' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 ">
                                        <div class="compAdd">
                                            <label>Fax Number</label>
                                            <p class="mt-1">{{ $user->fax_number??'----' }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    @if ($user->national ==1)
                                        <div class="col-lg-5 col-md-5 ">
                                            <div class="compAdd">
                                                <label>Registration Code</label>
                                                <p class="mt-1">{{ $user->reg_code??'----' }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-5 col-md-5 ">
                                            <div class="compAdd">
                                                <label>Tax Number</label>
                                                <p class="mt-1">{{ $user->tax_number??'----' }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        @if ( $user->for_company )
            <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionExCom" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">

                    <!-- Card header -->
                    <div class="card-header bg-white py-3 pl-0" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionExCom" href=".collapseDetailsCom" aria-expanded="true"
                            aria-controls="collapseDetailsCom">
                            <h5 class="mb-2 border-0">
                                Companies that you are Agent / Distributor for
                                <i class="float-right fas fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div class="collapse show borderd border-top-0 collapseDetailsCom" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionExCom">

                        <div class="card-body">
                            <div class="contanier">
                                <div class="addDetails p-2">
                                    <div class="container">
                                        @if(count($user->relatedCompany))
                                            @foreach ($user->relatedCompany as $key=>$relatedCom)
                                                @if($key == 0)
                                                    <div class="row">

                                                        <div class="col-lg-5 col-md-5 ">
                                                            <div class="compAdd">
                                                                <label>Company Name</label>
                                                                <p class="mt-1">{{ $relatedCom->name }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 col-md-5 ">
                                                            <div class="compAdd">
                                                                <label>Authorization File</label>
                                                                <p class="mt-1">{{ $user->file }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-md-2">
                                                            <a href="{{ $relatedCom->path }}"><i class="fa fa-download text-danger pt-4"></i></a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="border p-4 mt-4">
                                                        <div class="row">

                                                            <div class="col-lg-5 col-md-5 ">
                                                                <div class="compAdd">
                                                                    <label>Company Name</label>
                                                                    <p class="mt-1">{{ $relatedCom->name }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-5 col-md-5 ">
                                                                <div class="compAdd">
                                                                    <label>Authorization File</label>
                                                                    <p class="mt-1">{{ $relatedCom->file }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-2 col-md-2">
                                                                <a href="{{ $relatedCom->path }}"><i class="fa fa-download text-danger pt-4"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        @endif
        <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionDetail2" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card border-0 firstUploadCollapse">

                <!-- Card header -->
                <div class="card-header bg-white py-3 pl-0" role="tab">
                    <a data-toggle="collapse" data-parent="#accordionDetail2" href=".collapseDetailShow" aria-expanded="true"
                        aria-controls="collapseDetailShow">
                        <h5 class="mb-2 border-0">
                            Contacts
                            <i class="float-right fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div class="collapse show borderd border-top-0 collapseDetailShow" role="tabpanel" aria-labelledby="headingOne1"
                    data-parent="#accordionEx">
                    <div class="card-body">
                        <div class="container">
                            <div class="addDetails p-2">
                                @foreach ($user->contactPersons as $key => $contact)
                                    @if ($key ==0 )
                                        <div class="row">

                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Contact Person</label>
                                                    <p class="mt-1">{{ $contact->name??'----' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="compAdd">
                                                    <label>Contact Role</label>
                                                    <p class="mt-1">{{ $contact->role??'----' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">

                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Job Title</label>
                                                    <p class="mt-1">{{ $contact->job ?? '----' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Fax Number</label>
                                                    <p class="mt-1">{{ $contact->fax ?? '----' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">

                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Email</label>
                                                    <p class="mt-1">{{ $contact->email ?? '----' }}</p>
                                                </div>
                                            </div>
                                            @foreach ($contact->phones as $phone)

                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Phone Number</label>
                                                        <p class="mt-1">+{{ $phone->code }} {{ $phone->phone ?? '----' }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    @else
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                                <div class="card mt-4">
                                                    <div class="card-header py-1 px-0">
                                                        <h5 class="pl-2">{{ $numnames[$key]?? $key.'th' }} Contact </h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="compAdd">
                                                                        <label>Contact Person</label>
                                                                        <p class="mt-1">{{ $contact->name??'----' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="compAdd">
                                                                        <label>Contact Role</label>
                                                                        <p class="mt-1">{{ $contact->role??'----' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row pt-2">
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="compAdd">
                                                                        <label>Job Title</label>
                                                                        <p class="mt-1">{{ $contact->job??'----' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="compAdd">
                                                                        <label>Fax Number</label>
                                                                        <p class="mt-1">{{ $contact->fax }}</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row pt-2">

                                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                                    <div class="compAdd">
                                                                        <label>Email</label>
                                                                        <p class="mt-1">{{ $contact->email ?? '----' }}</p>
                                                                    </div>
                                                                </div>
                                                                @foreach ($contact->phones as $phone)

                                                                    <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                                        <div class="compAdd">
                                                                            <label>Phone Number</label>
                                                                            <p class="mt-1">+{{ $phone->code }} {{ $phone->phone ?? '----' }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @if ( $user->business_type != 'company' && $user->business_type != 'distributor')
            <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionDetail3" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">

                    <!-- Card header -->
                    <div class="card-header bg-white py-3 pl-0" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionDetail3" href=".collapseDetailShow3" aria-expanded="true"
                            aria-controls="collapseDetailShow3">
                            <h5 class="mb-2 border-0">
                                    Agent Information
                                <i class="float-right fas fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div class="collapse show borderd border-top-0 collapseDetailShow3" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionDetail3">
                        <div class="card-body">
                            <div class="container">
                                <div class="addDetails p-2">
                                    @foreach ($user->agents as $key => $agent)
                                        @if ($key == 0)
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Agent Name</label>
                                                        <p class="mt-1">{{ $agent->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Country</label>
                                                        <p class="mt-1">{{ $agent->country->name ?? '----' }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row pt-2">


                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Email Address</label>
                                                        <p class="mt-1">{{ $agent->email }}</p>
                                                    </div>
                                                </div>
                                                @foreach ($agent->phones as $phone)

                                                    <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                        <div class="compAdd">
                                                            <label>Phone Number</label>
                                                            <p class="mt-1">+{{ $phone->code }} {{ $phone->phone ?? '----' }}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="card mt-4">
                                                <div class="card-header py-1 px-0">
                                                    <h5 class="pl-2">{{ $numnames[$key]?? $key.'th' }} Agent </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <div class="compAdd">
                                                                    <label>Agent Name</label>
                                                                    <p class="mt-1">{{ $agent->name }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <div class="compAdd">
                                                                    <label>Country</label>
                                                                    <p class="mt-1">{{ $agent->country->name??'----' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row pt-2">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                                <div class="compAdd">
                                                                    <label>Email Address</label>
                                                                    <p class="mt-1">{{ $agent->email }}</p>
                                                                </div>
                                                            </div>
                                                            @foreach ($agent->phones as $phone)

                                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                                    <div class="compAdd">
                                                                        <label>Phone Number</label>
                                                                        <p class="mt-1">+{{ $phone->code }} {{ $phone->phone ?? '----' }}</p>
                                                                    </div>
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><br>
        @endif
        @if ($user->status == 3)
            <p class="text-right"><a href="{{ URL::to('supplier/editdata') }}" class="btn btnSubmit editBtn">Edit Company Details</a></p>
        @endif
    </div>

</div>
