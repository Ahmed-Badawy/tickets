<div id="bankAccountDetails" class="tab-pane p-0 container">
    <form class="bankEdit">
        <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionDetail3" role="tablist" aria-multiselectable="true">
            <!-- Accordion card -->
            <div class="card border-0 firstUploadCollapse">

                <!-- Card header -->
                <div class="card-header bg-white py-3 px-0" role="tab">
                    <a data-toggle="collapse" data-parent="#accordionDetail3" href=".collapseDetailShow3" aria-expanded="true"
                        aria-controls="collapseDetailShow3">
                        <h5 class="mb-2 border-0">
                                Bank Information
                            <i class="float-right fas fa-angle-down rotate-icon"></i>
                        </h5>
                    </a>
                </div>

                <!-- Card body -->
                <div class="collapse show borderd border-top-0 collapseDetailShow3" role="tabpanel" aria-labelledby="headingOne1"
                    data-parent="#accordionDetail3">
                    <div class="card-body">
                        <div class="addDetails p-2">
                            @foreach ($user->banks as $key => $bank)
                                @if ($key == 0)
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Name</label>
                                                    <p class="mt-1">{{ $bank->bank_name }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Abbreviation</label>
                                                    <p class="mt-1">{{ $bank->abbreviation }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Swift Code</label>
                                                    <p class="mt-1">{{ $bank->swift_code }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="compAdd">
                                                    <label>IBAN Code</label>
                                                    <p class="mt-1">{{ $bank->iban_code }}</p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Country</label>
                                                    <p class="mt-1">{{ $bank->country->name ??'----' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Account Number</label>
                                                    <p class="mt-1">{{ $bank->account_number }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                <div class="compAdd">
                                                    <label>Currency</label>
                                                    <p class="mt-1">{{ $bank->currency ??'----' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card mt-4">
                                        <div class="card-header py-1 px-0">
                                            <h5 class="pl-2">{{ $numnames[$key]?? $key.'th' }} Account</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Name</label>
                                                            <p class="mt-1">{{ $bank->bank_name }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Abbreviation</label>
                                                            <p class="mt-1">{{ $bank->abbreviation }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row pt-2">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Swift Code</label>
                                                            <p class="mt-1">{{ $bank->swift_code }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>IBAN Code</label>
                                                            <p class="mt-1">{{ $bank->iban_code }}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row pt-2">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Country</label>
                                                            <p class="mt-1">{{ $bank->country->name ??'----' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Account Number</label>
                                                            <p class="mt-1">{{ $bank->account_number }}</p>
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
        </div><br>
        @if ($user->status == 3)
            <p class="text-right"><a href="{{ URL::to('supplier/editdata') }}" class="btn btnSubmit btnEditBank">Edit Bank Account</a></p>
        @endif
    </form>

</div>
