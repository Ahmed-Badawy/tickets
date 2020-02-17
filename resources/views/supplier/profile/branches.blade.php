<div id="companyBranches" class="tab-pane p-0 container">
        <form class="showBran">
            <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionDetail3" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">

                    <!-- Card header -->
                    <div class="card-header bg-white px-0 py-3" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionDetail3" href=".collapseDetailShow3" aria-expanded="true"
                            aria-controls="collapseDetailShow3">
                            <h5 class="mb-2 border-0">
                                    Branch Information
                                <i class="float-right fas fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    @foreach ($user->branches as $key => $branch)
                        <div class="collapse show borderd border-top-0 collapseDetailShow3" role="tabpanel" aria-labelledby="headingOne1"
                            data-parent="#accordionDetail3">
                            <div class="card-body">
                                @if ($key == 0)
                                    <div class="addDetails p-2">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Name</label>
                                                        <p class="mt-1">{{ $branch->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Address</label>
                                                        <p class="mt-1">{{ $branch->address }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">

                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Country</label>
                                                        <p class="mt-1">{{ $branch->country->name ?? '----' }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>City</label>
                                                        <p class="mt-1">{{ $branch->city->name?? '----' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">

                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Email Address</label>
                                                        <p class="mt-1">{{ $branch->email }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                                    <div class="compAdd">
                                                        <label>Fax</label>
                                                        <p class="mt-1">{{ $branch->fax }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card mt-4">
                                        <div class="card-header py-1 px-0">
                                            <h5 class="pl-2">{{ $numnames[$key]?? $key.'th' }} Branch</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Name</label>
                                                            <p class="mt-1">{{ $branch->name?? '----' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Address</label>
                                                            <p class="mt-1">{{ $branch->address?? '----' }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row pt-2">
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Country</label>
                                                            <p class="mt-1">{{ $branch->country->name?? '----' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>City</label>
                                                            <p class="mt-1">{{ $branch->city->name?? '----' }}</p>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row pt-2">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Email Address</label>
                                                            <p class="mt-1">{{ $branch->email?? '----' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <div class="compAdd">
                                                            <label>Fax</label>
                                                            <p class="mt-1">{{ $branch->fax?? '----' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
            </div><br>
            @if ($user->status == 3)
                <p class="text-right"><a href="{{ URL::to('supplier/editdata') }}" class="btn btnSubmit btnEditBran">Edit Branches</a ></p>
            @endif
        </form>

    </div>



