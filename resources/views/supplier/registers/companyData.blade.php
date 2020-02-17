
<div id="companyDetails" class="tab-pane container p-0 fade active show ">
    <form method="POST" enctype="multipart/form-data" files="true" action="{{ URL::to('supplier') }}" id="companyForm">
        {{ csrf_field() }}
        <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionExEx" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card border-0 firstUploadCollapse">
                <!-- Card header -->
                <div class="card-header bg-white p-3" role="tab">
                    <a data-toggle="collapse" data-parent="#accordionExEx" href=".collapseDetailsBs" aria-expanded="true"
                        aria-controls="collapseDetailsBs">
                        <h5 class="mb-2 px-0 border-0">
                            Basic Information
                            <i class="float-right fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>
                <!-- Card body -->
                <div class="collapse show borderd border-top-0 collapseDetailsBs" role="tabpanel" aria-labelledby="headingOne1"
                    data-parent="#accordionExEx">
                    <div class="card-body">
                        <div class="addDetails py-2 px-3">
                            <div class="container">
                                <div class="row">

                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                        <div class="form-group">
                                            <label>Company Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                            title="Provide the most accurate address of your headquarter">
                                            <i class="far fa-question-circle"></i></span>
                                            <input type="text" name="address" value="{{ $user->address ?? '' }}" class="form-control"
                                                placeholder="Enter your address"
                                                aria-describedby="helpId">

                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                        <div class="form-group">
                                            <label>Commercial Name </label> <span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                            title="Provide your company's most popular name 'Trade Name'">
                                            <i class="far fa-question-circle"></i></span>
                                            <input type="text" class="form-control" name="commercial_name" value="{{ $user->commercial_name ?? '' }}"  placeholder="Add your commercial name"
                                                aria-describedby="helpId">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                        <div class="form-group">
                                            <label>Country</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                            title="Choose the country of your headquarter">
                                            <i class="far fa-question-circle"></i></span>
                                            <select name="country_id" id="country_id" class="form-control">
                                                    <option value="" disabled {{ $user->country_id ? '' : 'selected' }}>Choose Country</option>
                                                    @foreach (\App\Models\Country::all() as $country)
                                                        <option value="{{ $country->id }}" {{ ($user->country_id == $country->id) ? 'selected' : '' }}> {{ $country->name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                        <div class="form-group">
                                            <label>City </label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Choose the city of your headquarter"><i class="far fa-question-circle"></i></span>
                                            <select id="city_id" name="city_id" class="form-control">
                                                <option disabled value="" selected>Choose City</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                        <div class="form-group">
                                            <label>
                                                Phone Number<span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide valid phone number for better communications"><i class="far fa-question-circle"></i></span>
                                            </label>
                                            @include("supplier.registers.selectPhoneCountry",['codeName' => 'phone_code', 'codeValue'=>''])

                                            <input class="form-control col-8 float-right" type="number" value="{{ $user->phone }}" name="phone" pattern="[1-9]+" title="Please add numbers only"
                                            placeholder="Add Phone" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-5 col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <label> Phone Number </label>
                                            @include("supplier.registers.selectPhoneCountry",['codeName' => 'phone_code', 'codeValue'=>''])

                                            <input class="form-control" type="text" name="phone" pattern="[1-9]+" title="Please add numbers only" value="{{ $user->phone ?? '' }}"
                                                placeholder="Add Phone" aria-describedby="helpId">
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>

                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                            <input type="number" name="fax_number" value="{{ $user->fax_number ?? '' }}"  class="form-control"
                                                placeholder="Enter Your Fax Number" aria-describedby="helpId">
                                        </div>
                                    </div>

                                </div>

                                <div class="row pt-2">
                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                        <div class="form-group">
                                            <label>Website</label><span class="float-right"><small>(Optional)</small></span>
                                            <input name="website" value="{{ $user->website ?? '' }}"  type="text"  class="form-control"
                                                placeholder="Add your company website" aria-describedby="helpId">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                        <div class="form-group">
                                            <label> Corporate Email</label><span class="float-right"><small>(Optional)</small></span>
                                            <input name="corporate_email" value="{{ $user->corporate_email ?? '' }}"  type="email"  class="form-control"
                                                placeholder="Add a corporate email" aria-describedby="helpId">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @if ($user->national ==1)
                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                            <div class="form-group">
                                                <label>Registration Code</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                title="Provide your company's registration code"><i class="far fa-question-circle"></i></span>
                                                <input type="number" value="{{ $user->reg_code }}" name="reg_code" class="form-control"
                                                    placeholder="Add your Registration Code"
                                                    aria-describedby="helpId">
                                            </div>
                                        </div>
                                    @else

                                        <div class="col-lg-5 col-md-5 col-sm-5">
                                            <div class="form-group">
                                                <label>Tax Number</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide the accurate Tax number 'nine-digits' "><i class="far fa-question-circle"></i></span>
                                                <input type="number" value="{{ $user->tax_number }}" name="tax_number" class="form-control"
                                                    placeholder="Add your company Tax Number"
                                                    aria-describedby="helpId">
                                            </div>
                                        </div>
                                    @endif
                                    <!--    -->
                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Accordion card -->
        </div>
        @if ( $user->for_company )
            <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionData" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">
                    <!-- Card header -->
                    <div class="card-header bg-white p-3" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionData" href=".collapseDetailsBs2" aria-expanded="true"
                            aria-controls="collapseDetailsBs2">
                            <h5 class="mb-2 px-0 border-0">
                                Companies that you are Agent / Distributor for
                                <i class="float-right fas fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>
                    <!-- Card body -->
                    <div class="collapse show borderd border-top-0 collapseDetailsBs2" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionData">
                        <div class="card-body">
                            <div class="addDetails py-2 px-3">
                                <div class="container">
                                    <div id="relatedComDiv">
                                        @if(count($user->relatedCompany))
                                            @foreach ($user->relatedCompany as $key=>$relatedCom)
                                                @if($key == 0)
                                                    <div class="row">
    
                                                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                            <div class="form-group">
                                                                <label>Company Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                                title="Company that you are Agent / Distributor for">
                                                                <i class="far fa-question-circle"></i></span>
                                                                <input type="text" value="{{ $relatedCom->name }}" name="relatedCompany[name][]" value="" class="form-control"
                                                                    placeholder="Enter Company Name"
                                                                    aria-describedby="helpId">
    
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                        <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                            <label>Authorization Letter</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                                title="Upload Authorization Letter">
                                                                <i class="far fa-question-circle"></i></span>
                                                            <input name="relatedCompany[file][]" accept=".pdf" type="file" class="mt-1">
                                                        </div>
                                                        
                                                    </div>
                                                @else
                                                    <div class="row relatedComRow">
                                                        <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                                            <div class="card mt-4">
                                                                <div class="card-body">
                                                                    <div class="container">
                                                                        <div class="row justify-content-around">
                
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Company Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                                                    title="Company that you are Agent / Distributor for">
                                                                                    <i class="far fa-question-circle"></i></span>
                                                                                    <input value="{{ $relatedCom->name }}" type="text" name="address" value="" class="form-control"
                                                                                        placeholder="Enter Company Name" aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-5 col-md-5 col-sm-5">
                                                                                <label>Authorization Letter</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                                                    title="Upload Authorization Letter">
                                                                                    <i class="far fa-question-circle"></i></span>
                                                                                <input type="file" name="relatedCompany[file][]" accept=".pdf" class="mt-1">
                                                                            </div>
                                                                            <div class="col-lg-1 col-sm-1 col-md-1">
                                                                                <span onclick="removeRelatedCom(this)" class="float-right mt-4"><img src="{{ asset('images/bin.svg') }}"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            
                                        @else
                                            <div class="row">
    
                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Company Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                        title="Company that you are Agent / Distributor for">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input type="text" name="relatedCompany[name][]" value="" class="form-control"
                                                            placeholder="Enter Company Name"
                                                            aria-describedby="helpId">
    
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <label>Authorization Letter</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                        title="Upload Authorization Letter">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input name="relatedCompany[file][]" accept=".pdf" type="file" class="mt-1">
                                                </div>
                                                
                                            </div>
                                        @endif
                                    </div>

                                    

                                    <button type="button" onclick="addRelatedCom()" class="btn mt-3 btnClickAddContact border-0">
                                        <i class="fa fa-plus-circle"></i> Add More Companies
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Accordion card -->
            </div>
        @endif

        <div class="accordion md-accordion mt-5 mb-5" id="accordionEx2" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card border-0 firstUploadCollapse">

                <!-- Card header -->
                <div class="card-header bg-white py-3 px-0" role="tab">
                    <a data-toggle="collapse" data-parent="#accordionEx2" href=".collapseDetails2"
                        aria-expanded="true" aria-controls="collapseDetails2">
                        <h5 class="mb-2 border-bottom-0">
                            Contact Information
                            <i class="float-right fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div class="collapse show borderd border-top-0 collapseDetails2" role="tabpanel" aria-labelledby="headingOne1"
                    data-parent="#accordionEx2">
                    <div class="card-body">
                            <div class="addDetails py-2">
                                <div class="container">
                                @if (count($user->contactPersons))
                                    @foreach ($user->contactPersons as $key => $contactPerson)
                                        @if ($key ==0)
                                            <div class="row">

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Contact Person</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide the name of whom SUMD may connect with">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input value="{{ $contactPerson->name ?? '' }}" name="person[name][]" type="text"  class="form-control" placeholder="Add contact person"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Contact Role</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Make sure that your 'Contact Person' at one of these departments ">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <select class="form-control" name="person[role][]">
                                                            <option disabled value="" selected>Choose Contact Role</option>
                                                            <option value="Sales" {{ ($contactPerson->role == 'Sales') ? 'selected' : '' }}>Sales </option>
                                                            <option value="Financial" {{ ($contactPerson->role == 'Financial') ? 'selected' : '' }}>Financial </option>
                                                            <option value="Technical" {{ ($contactPerson->role == 'Technical') ? 'selected' : '' }}>Technical </option>
                                                            <option value="Logistics" {{ ($contactPerson->role == 'Logistics') ? 'selected' : '' }}>Logistics </option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Job Title</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide the position of your 'Contact Person'">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input value="{{ $contactPerson->job ?? '' }}" name="person[job][]" type="text"  class="form-control" placeholder="Add your job title"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                                        <input value="{{ $contactPerson->fax ?? '' }}" name="person[fax][]" type="number"  class="form-control" placeholder="Add your Fax Number"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Email</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide an official email for better communications">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input value="{{ $contactPerson->email ?? '' }}" name="person[email][]" type="email"  class="form-control" placeholder="Add your contact Email"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                @if (count($contactPerson->phones))
                                                    @foreach ($contactPerson->phones as $phonekey=>$phone)
                                                        @if ($phonekey == 0)

                                                            <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                                <div class="form-group">
                                                                    <label>
                                                                        Phone Number
                                                                        <i class="fa fa-plus float-right addPhoneNum" data-key="{{ $key }}" data-type="person"> add more </i>
                                                                    </label>
                                                                    @include("supplier.registers.selectPhoneCountry",['codeName' => 'person[codes]['.$key.'][]', 'codeValue'=>$phone->code])
                                                                    <input class="form-control col-8 float-right" value="{{ $phone->phone }}" type="number" name="person[phone][{{ $key }}][]" pattern="[1-9]+" title="Please add numbers only"
                                                                    placeholder="Add your contact phone" aria-describedby="helpId">
                                                                </div>
                                                            </div>
                                                        @else
                                                        @if ($phonekey % 2 == 0)
                                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                        @endif
                                                            @include('supplier.registers.phones',['codename' =>'person[codes]['.$key.'][]', 'codevalue'=>$phone->code, 'phonename'=> 'person[phone]['.$key.'][]', 'phonevalue'=>$phone->phone])
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                        <div class="form-group">
                                                            <label>
                                                                Phone Number
                                                                <i class="fa fa-plus float-right addPhoneNum" data-key="{{ $key }}" data-type="person"> add more </i>
                                                            </label>
                                                            @include("supplier.registers.selectPhoneCountry",['codeName' => 'person[codes]['.$key.'][]', 'codeValue'=>''])
                                                            <input class="form-control col-8 float-right" type="number" name="person[phone][{{ $key }}][]" pattern="[1-9]+" title="Please add numbers only"
                                                            placeholder="Add your contact phone" aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            @if ($key == 1)
                                                <div id="contactDiv">
                                            @endif
                                                    <div class="row contactRow">
                                                        <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                                            <div class="card mt-4">
                                                                <div class="card-header py-1 px-0">
                                                                    <h5 class="pl-2 contactOrder">  <span onclick="removecontact(this)" class="float-right"><img src="{{ asset('images/bin.svg') }}"></span></h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="container">
                                                                        <div class="row">

                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Contact Person</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the
                                                                                    directions"><i class="far fa-question-circle"></i></span>
                                                                                    <input type="text" value="{{ $contactPerson->name ?? '' }}" name="person[name][]"  class="form-control" placeholder="Add contact person"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Contact Role</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Make sure that your 'Contact Person' at one of these departments ">
                                                                                    <i class="far fa-question-circle"></i></span>
                                                                                    <select class="form-control" name="person[role][]">
                                                                                        <option disabled value="" selected>Choose Contact Role</option>
                                                                                        <option value="Sales" {{ ($contactPerson->role == 'Sales') ? 'selected' : '' }}>Sales </option>
                                                                                        <option value="Financial" {{ ($contactPerson->role == 'Financial') ? 'selected' : '' }}>Financial </option>
                                                                                        <option value="Technical" {{ ($contactPerson->role == 'Technical') ? 'selected' : '' }}>Technical </option>
                                                                                        <option value="Logistics" {{ ($contactPerson->role == 'Logistics') ? 'selected' : '' }}>Logistics </option>

                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Job Title</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide the position of your 'Contact Person'">
                                                                                    <i class="far fa-question-circle"></i></span>
                                                                                    <input value="{{ $contactPerson->job ?? '' }}" name="person[job][]" type="text"  class="form-control" placeholder="Add your job title"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                                                                    <input type="number" pattern="[0-9]{9}" value="{{ $contactPerson->fax ?? '' }}" name="person[fax][]" class="form-control" placeholder="Add Phone"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Email</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide an official email for better communications">
                                                                                    <i class="far fa-question-circle"></i></span>
                                                                                    <input value="{{ $contactPerson->email ?? '' }}" name="person[email][]" type="email"  class="form-control" placeholder="Add your contact Email"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>


                                                                            @if (count($contactPerson->phones))
                                                                                @foreach ($contactPerson->phones as $phonekey=>$phone)
                                                                                    @if ($phonekey == 0)

                                                                                        <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                                                            <div class="form-group">
                                                                                                <label>
                                                                                                    Phone Number
                                                                                                    <i class="fa fa-plus float-right addPhoneNum" data-key="{{ $key }}" data-type="person"> add more </i>
                                                                                                </label>
                                                                                                @include("supplier.registers.selectPhoneCountry",['codeName' => 'person[codes]['.$key.'][]', 'codeValue'=>$phone->code])
                                                                                                <input class="form-control col-8 float-right" value="{{ $phone->phone }}" type="number" name="person[phone][{{ $key }}][]" pattern="[1-9]+" title="Please add numbers only"
                                                                                                placeholder="Add your contact phone" aria-describedby="helpId">
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        @if ($phonekey % 2 == 0)
                                                                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                                        @endif
                                                                                        @include('supplier.registers.phones',['codename' =>'person[codes]['.$key.'][]', 'codevalue'=>$phone->code, 'phonename'=> 'person[phone]['.$key.'][]', 'phonevalue'=>$phone->phone])
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                                                    <div class="form-group">
                                                                                        <label>
                                                                                            Phone Number
                                                                                            <i class="fa fa-plus float-right addPhoneNum" data-key="{{ $key }}" data-type="person"> add more </i>
                                                                                        </label>
                                                                                        @include("supplier.registers.selectPhoneCountry",['codeName' => 'person[codes]['.$key.'][]', 'codeValue'=>''])
                                                                                        <input class="form-control col-8 float-right" type="number" name="person[phone][{{ $key }}][]" pattern="[1-9]+" title="Please add numbers only"
                                                                                        placeholder="Add your contact phone" aria-describedby="helpId">
                                                                                    </div>
                                                                                </div>
                                                                            @endif



                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @if ($key == count($user->contactPersons)- 1)
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                    @if (count($user->contactPersons) == 1)
                                        <div id="contactDiv">

                                        </div>
                                    @endif
                                @else
                                    <div class="container">
                                        <div class="row">

                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Contact Person </label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide the name of whom SUMD may connect with">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input name="person[name][]" type="text"  class="form-control" placeholder="Add contact person"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Contact Role</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Make sure that your 'Contact Person' at one of these departments ">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <select class="form-control" name="person[role][]">
                                                        <option disabled value="" selected>Choose Contact Role</option>
                                                        <option value="Sales">Sales </option>
                                                        <option value="Financial">Financial </option>
                                                        <option value="Technical">Technical </option>
                                                        <option value="Logistics">Logistics </option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Job Title</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide the position of your 'Contact Person'">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input  name="person[job][]" type="text"  class="form-control" placeholder="Add your job title"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                                    <input name="person[fax][]" type="number"  class="form-control" placeholder="Add your Fax Number"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Email</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide an official email for better communications">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input name="person[email][]" type="email"  class="form-control" placeholder="Add your contact Email"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>

                                            <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                <div class="form-group">
                                                    <label>
                                                        Phone Number
                                                        <i class="fa fa-plus float-right addPhoneNum" data-key="0" data-type="person"> add more </i>
                                                    </label>
                                                    @include("supplier.registers.selectPhoneCountry",['codeName' => 'person[codes][0][]', 'codeValue'=>''])
                                                    <input class="form-control col-8 float-right" type="number" name="person[phone][0][]" pattern="[1-9]+" title="Please add numbers only"
                                                    placeholder="Add your contact phone" aria-describedby="helpId">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="contactDiv">

                                    </div>
                                @endif

                                <div class="row">

                                    <div class="col-lg-5">
                                        <button type="button" class="mt-3 btnClickAddContact border-0" onclick="Addcontact()"><i class="fa fa-plus-circle"></i> Add more contacts</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Accordion card -->
        </div>
        @if ( $user->business_type != 'company' && $user->business_type != 'distributor')
            <div class="accordion md-accordion mt-5 mb-5" id="accordionEx3" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">

                    <!-- Card header -->
                    <div class="card-header bg-white p-3 px-0" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionEx3" href=".collapseDetails3" aria-expanded="true"
                            aria-controls="collapseDetails3">
                            <h5 class="mb-2 border-bottom-0">
                                    Agent Information
                                <i class="float-right fas fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div class="collapse show borderd border-top-0 collapseDetails3" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionEx3">
                        <div class="card-body">
                            <div class="addDetails py-2 px-3">
                                <div class="container">
                                    @if (count($user->agents))
                                        @foreach ($user->agents as $key => $agent)
                                            @if ($key == 0)
                                                <div class="row">

                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Agent Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide your Agent's name and other accurate details">
                                                        <i class="far fa-question-circle"></i></span>
                                                            <input type="text" value="{{ $agent->name }}" name="agent[name][{{ $key }}]" class="form-control" placeholder="Add contact person"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Country</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Where your Agent is located">
                                                        <i class="far fa-question-circle"></i></span>
                                                            <select class="form-control" name="agent[country_id][{{ $key }}]">
                                                                <option disabled value="" selected>Choose Country</option>
                                                                @foreach (\App\Models\Country::all() as $country)
                                                                    <option value="{{ $country->id }}" {{ ($agent->country_id == $country->id) ? 'selected' : '' }}> {{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Email Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide a valid email for better communications">
                                                        <i class="far fa-question-circle"></i></span>
                                                            <input type="email" value="{{ $agent->email }}" name="agent[email][{{ $key }}]" class="form-control" placeholder="Add email address"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>



                                                    @if (count($agent->phones))
                                                        @foreach ($agent->phones as $phonekey=>$phone)
                                                            @if ($phonekey == 0)

                                                                <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                                    <div class="form-group">
                                                                        <label>
                                                                            Phone Number
                                                                            <i class="fa fa-plus float-right addPhoneNum" data-key="{{ $key }}" data-type="agent"> add more </i>
                                                                        </label>
                                                                        @include("supplier.registers.selectPhoneCountry",['codeName' => 'agent[codes]['.$key.'][]', 'codeValue'=>$phone->code])
                                                                        <input class="form-control col-8 float-right" value="{{ $phone->phone }}" type="number" name="agent[phone][{{ $key }}][]" pattern="[1-9]+" title="Please add numbers only"
                                                                        placeholder="Add your contact phone" aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                            @else
                                                            @if ($phonekey % 2 == 0)
                                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                            @endif
                                                                @include('supplier.registers.phones',['codename' =>'agent[codes]['.$key.'][]', 'codevalue'=>$phone->code, 'phonename'=> 'agent[phone]['.$key.'][]', 'phonevalue'=>$phone->phone])
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                            <div class="form-group">
                                                                <label>
                                                                    Phone Number
                                                                    <i class="fa fa-plus float-right addPhoneNum" data-key="{{ $key }}" data-type="agent"> add more </i>
                                                                </label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                                <i class="far fa-question-circle"></i></span>
                                                                @include("supplier.registers.selectPhoneCountry",['codeName' => 'agent[codes]['.$key.'][]', 'codeValue'=>''])
                                                                <input class="form-control col-8 float-right" type="number" name="agent[phone][{{ $key }}][]" pattern="[1-9]+" title="Please add numbers only"
                                                                placeholder="Add your contact phone" aria-describedby="helpId">
                                                            </div>
                                                        </div>
                                                    @endif


                                                </div>
                                            @else
                                                @if ($key == 1)
                                                    <div id="agentDiv">
                                                @endif
                                                        <div class="row agentRow">
                                                            <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                                                <div class="card mt-2">
                                                                    <div class="card-header p-1">
                                                                        <h5 class="pl-2 orderagent" onclick="removeagent(this)">  <span class="float-right"><img src="{{ asset('images/bin.svg') }}"></span></h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="container">
                                                                            <div class="row">

                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>Agent Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide your Agent's name and other accurate details">
                                                                                        <i class="far fa-question-circle"></i></span>
                                                                                        <input type="text" value="{{ $agent->name }}" name="agent[name][{{ $key }}]" class="form-control" placeholder="Add agent name"
                                                                                            aria-describedby="helpId">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>

                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>Country</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Where your Agent is located">
                                                                                        <i class="far fa-question-circle"></i></span>
                                                                                        <select class="form-control" name="agent[country_id][{{ $key }}]">
                                                                                            <option disabled value="" selected>Choose Country</option>
                                                                                            @foreach (\App\Models\Country::all() as $country)
                                                                                                <option value="{{ $country->id }}" {{ ($agent->country_id == $country->id) ? 'selected' : '' }}> {{ $country->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">

                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>Email Address</label>
                                                                                        <input type="email" value="{{ $agent->email }}" name="agent[email][{{ $key }}]" class="form-control" placeholder="Add email address"
                                                                                            aria-describedby="helpId">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>



                                                                                @if (count($agent->phones))
                                                                                    @foreach ($agent->phones as $phonekey=>$phone)
                                                                                        @if ($phonekey == 0)

                                                                                            <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                                                                <div class="form-group">
                                                                                                    <label>
                                                                                                        Phone Number
                                                                                                        <i class="fa fa-plus float-right addPhoneNum" data-key="{{ $key }}" data-type="agent"> add more </i>
                                                                                                    </label>
                                                                                                    @include("supplier.registers.selectPhoneCountry",['codeName' => 'agent[codes]['.$key.'][]', 'codeValue'=>$phone->code])
                                                                                                    <input class="form-control col-8 float-right" value="{{ $phone->phone }}" type="number" name="agent[phone][{{ $key }}][]" pattern="[1-9]+" title="Please add numbers only"
                                                                                                    placeholder="Add your contact phone" aria-describedby="helpId">
                                                                                                </div>
                                                                                            </div>
                                                                                        @else
                                                                                            @if ($phonekey % 2 == 0)
                                                                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                                            @endif

                                                                                            @include('supplier.registers.phones',['codename' =>'agent[codes]['.$key.'][]', 'codevalue'=>$phone->code, 'phonename'=> 'agent[phone]['.$key.'][]', 'phonevalue'=>$phone->phone])
                                                                                        @endif
                                                                                    @endforeach
                                                                                @else
                                                                                    <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                                                        <div class="form-group">
                                                                                            <label>
                                                                                                Phone Number
                                                                                                <i class="fa fa-plus float-right addPhoneNum" data-key="{{ $key }}" data-type="agent"> add more </i>
                                                                                            </label>
                                                                                            @include("supplier.registers.selectPhoneCountry",['codeName' => 'agent[codes]['.$key.'][]', 'codeValue'=>''])
                                                                                            <input class="form-control col-8 float-right" type="number" name="agent[phone][{{ $key }}][]" pattern="[1-9]+" title="Please add numbers only"
                                                                                            placeholder="Add your contact phone" aria-describedby="helpId">
                                                                                        </div>
                                                                                    </div>
                                                                                @endif



                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if ($key == count($user->agents)- 1)
                                                    </div>
                                                @endif

                                            @endif
                                        @endforeach
                                        @if (count($user->agents) == 1)
                                            <div id="agentDiv">

                                            </div>
                                        @endif
                                    @else
                                        <div class="row">

                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Agent Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide your Agent's name and other accurate details">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input type="text" name="agent[name][]" class="form-control" placeholder="Add contact person"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Country</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Where your Agent is located">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <select class="form-control" name="agent[country_id][]">
                                                        <option disabled value="" selected>Choose Country</option>
                                                        @foreach (\App\Models\Country::all() as $country)
                                                            <option value="{{ $country->id }}"> {{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Email Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide a valid email for better communications">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input type="email"  name="agent[email][0]" class="form-control" placeholder="Add email address"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>



                                            <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                <div class="form-group">
                                                    <label>
                                                        Phone Number
                                                        <i class="fa fa-plus float-right addPhoneNum" data-key="0" data-type="agent"> add more </i>
                                                    </label>
                                                    @include("supplier.registers.selectPhoneCountry",['codeName' => 'agent[codes][0][]', 'codeValue'=>''])
                                                    <input class="form-control col-8 float-right" type="number" name="agent[phone][0][]" pattern="[1-9]+" title="Please add numbers only"
                                                    placeholder="Add your contact phone" aria-describedby="helpId">
                                                </div>
                                            </div>

                                        </div>
                                        <div id="agentDiv">

                                        </div>
                                    @endif
                                    <div class="row">

                                        <div class="col-lg-5">
                                            <button type="button" onclick="addagent()" class="mt-3 btnClickAddContact border-0"><i class="fa fa-plus-circle"></i> Add more agents </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Accordion card -->
            </div>
        @endif

        <button type="submit" class="btn btnSubmit float-right mb-2">Save and Continue <i class="fa fa-angle-right"></i></button><br>
    </form>
</div>



@push('scripts')
    <script>
        let agentaccount = parseInt('{{ count($user->agents) }}') ;
        let contactaccount = parseInt('{{ count($user->contactPersons) }}') ;
        $(document).on("click",".addPhoneNum", function(evt){
            let name = $(this).attr('data-type');
            let key = $(this).attr('data-key');
            let html = "";
            let space = `<div class="col-lg-2 col-sm-1 col-md-1 space"></div>`
            if(($(".phoneNum").length%2)==1) html += space ;
            html += `<div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                        <div class="form-group">
                            <label>
                                Phone Number
                                <i class="far fa-trash-alt float-right deletePhoneNum"></i>
                            </label>
                            @include("supplier.registers.selectPhoneCountry",['codeName' => '`+name+`[codes][`+key+`][]', 'codeValue'=>''])
                            <input class="form-control col-8 float-right" type="number" name="`+name+`[phone][`+key+`][]" pattern="[1-9]+" title="Please add numbers only" value=""
                                placeholder="Add Phone" aria-describedby="helpId">
                        </div>
                    </div>
                    `;
            let parent = $(evt.target).parent().parent().parent();
            $(html).insertAfter( parent );
            parent.parent().find(".space").remove();
            parent.parent().find(".phoneNum").each((index,subElm)=>{
                let otherIndex = index+2;
                if((otherIndex%2)==1) $(space).insertAfter(subElm);
            });
        });
        $(document).on("click",".deletePhoneNum",function(evt){
            let space = `<div class="col-lg-2 col-sm-1 col-md-1 space"></div>`
            let parent = $(evt.target).parent().parent().parent();
            let bigParent = $(evt.target).parent().parent().parent().parent();
            parent.remove();
            bigParent.find(".space").remove();
            bigParent.find(".phoneNum").each((index,subElm)=>{
                let otherIndex = index+2;
                if((otherIndex%2)==1){
                    $(space).insertAfter(subElm);
                }
            });
        })



        $(document).on('change', '#country_id', function(e){
            var id = $(this).val();
            let cityId ="{{ $user->city_id ?? 0 }}";
            cityId = parseInt(cityId);
            $.get('{{ URL::to("supplier/getcities") }}/' + id, function(data){
                if(Array.isArray(data.result)){
                    $('#city_id').html('');
                    $.each(data.result, function( index, value ) {
                        if(value.id == cityId)
                            $('#city_id').append('<option value="'+value.id+'" selected>'+ value.name +'</option>');
                        else
                            $('#city_id').append('<option value="'+value.id+'">'+ value.name +'</option>');

                    });
                }
            });
        });

        $('#companyForm')
            .ajaxForm({
                url : $('#companyForm').attr('action'),
                type : $('#companyForm').attr('method'),
                dataType : 'json',
                success : function (response) {
                    $('.form-control').removeClass('inputFieldStyle');
                    if(response.success){
                        $('#flash-container').css('display','block');
                            setTimeout(function(){
                                $('#flash-container').css('display','none');
                            }, 4000);
                        $('a[href="#branches"]').click();
                        window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
                    }
                    else{
                    }
                },
                error: function (response){
                    $.each(response.responseJSON.errors, function (key, value) {
                        var input = $('#companyForm').find('input[name=' + key + ']');
                        $(input).addClass('inputFieldStyle');
                        $(input).next().css('display','block');
                    });
                }
            });



        function removeAgentphone(that){
            $(that).parent().remove();
        }
        function addagent(){
            var html = `
                        <div class="row agentRow">
                            <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                <div class="card mt-4">
                                    <div class="card-header py-1 px-0">
                                        <h5  class="pl-2 orderagent"> <span onclick="removeagent(this)" class="float-right"><img src="{{ asset('images/bin.svg') }}"></span></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Agent Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide your Agent's name and other accurate details">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input type="text" name="agent[name][]" class="form-control" placeholder="Add agent name"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Country</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Where your Agent is located">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <select class="form-control" name="agent[country_id][]">
                                                            <option disabled value="" selected>Choose Country</option>
                                                            @foreach (\App\Models\Country::all() as $country)
                                                                <option value="{{ $country->id }}"> {{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Email Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide a valid email for better communications">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input type="email" name="agent[email][]" class="form-control" placeholder="Add email address"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum">
                                                    <div class="form-group">
                                                        <label>
                                                            Phone Number
                                                            <i class="fa fa-plus float-right addPhoneNum" data-key="`+agentaccount+`" data-type="agent"> add more </i>
                                                        </label>
                                                        @include("supplier.registers.selectPhoneCountry",['codeName' => 'agent[codes][`+agentaccount+`][]', 'codeValue'=>''])
                                                        <input class="form-control col-8 float-right" type="number" name="agent[phone][`+agentaccount+`][]" pattern="[1-9]+" title="Please add numbers only"
                                                        placeholder="Add your contact phone" aria-describedby="helpId">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
            agentaccount++;
            $('#agentDiv').append(html);
            addordernumber(document.getElementsByClassName("orderagent"), 'Agent', "removeagent(this)");
        }
        function Addcontact(){

            var html = `
                        <div class="row contactRow pt-2">
                            <div class="col-lg-12 col-sm-11 col-md-11 col-12>
                                <div class="card mt-4">
                                    <div class="card-header py-1 px-0">
                                        <h5 class="pl-2 contactOrder">Second Contact <span onclick="removecontact(this)" class="float-right"><img src="{{ asset('images/bin.svg') }}"></span></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Contact Person</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide the name of whom SUMD may connect with">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input type="text"  name="person[name][]"  class="form-control" placeholder="Add contact person"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Contact Role</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Make sure that your 'Contact Person' at one of these departments ">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <select class="form-control" name="person[role][]">
                                                            <option disabled value="" selected>Choose Contact Role</option>
                                                            <option value="Sales">Sales </option>
                                                            <option value="Financial">Financial </option>
                                                            <option value="Technical">Technical </option>
                                                            <option value="Logistics">Logistics </option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Job Title</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide the position of your 'Contact Person'">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input  name="person[job][]" type="text"  class="form-control" placeholder="Add your job title"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                                        <input type="number" pattern="[0-9]{9}" name="person[fax][]" class="form-control" placeholder="Add Phone"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Email</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Provide a valid email for better communications">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input name="person[email][]" type="email"  class="form-control" placeholder="Add your contact Email"
                                                            aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>

                                                    <div class="col-lg-5 col-md-5 col-sm-5 mt-2 mb-2 phoneNum" >
                                                    <div class="form-group">
                                                        <label>
                                                            Phone Number
                                                            <i class="fa fa-plus float-right addPhoneNum" data-key="`+contactaccount+`" data-type="person"> add more </i>
                                                        </label>
                                                        @include("supplier.registers.selectPhoneCountry",['codeName' => 'person[codes][`+contactaccount+`][]', 'codeValue'=>''])
                                                        <input class="form-control col-8 float-right" type="number" name="person[phone][`+contactaccount+`][]" pattern="[1-9]+" title="Please add numbers only"
                                                        placeholder="Add your contact phone" aria-describedby="helpId">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
            $('#contactDiv').append(html);
            contactaccount++;
            addordernumber(document.getElementsByClassName("contactOrder"), 'Contact', "removecontact(this)");
        }
        function removeagent(e){
            e.closest('div.agentRow').remove();
            addordernumber(document.getElementsByClassName("orderagent"), 'Agent', "removeagent(this)");
        }
        function removecontact(e){
            e.closest('div.contactRow').remove();
            addordernumber(document.getElementsByClassName("contactOrder"), 'Contact', "removecontact(this)");
        }
        $(document).on('change', '.projectscope', function(e){
            if($(this).val() == 0 ){
                $(this).parent().next().css('display','block')
            } else {
                $(this).parent().next().css('display','none')
            }
        })
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        })

        function addRelatedCom(){
            let html =  `<div class="row relatedComRow">
                            <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row justify-content-around">

                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                    <div class="form-group">
                                                        <label>Company Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                        title="Company that you are Agent / Distributor for">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <input type="text" name="relatedCompany[name][]" value="" class="form-control"
                                                            placeholder="Enter Company Name" aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-5 col-md-5 col-sm-5">
                                                    <label>Authorization Letter</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top"
                                                        title="Upload Authorization Letter">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input type="file" accept=".pdf" name="relatedCompany[file][]" class="mt-1">
                                                </div>
                                                <div class="col-lg-1 col-sm-1 col-md-1">
                                                    <span onclick="removeRelatedCom(this)" class="float-right mt-4"><img src="{{ asset('images/bin.svg') }}"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            $('#relatedComDiv').append(html);
        }

        function removeRelatedCom(e){
            e.closest('div.relatedComRow').remove();
        }
    </script>
@endpush
