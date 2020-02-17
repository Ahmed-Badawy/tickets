    <div id="showActivities" class="tab-pane p-0 container">
        @foreach ($user->activities as $key=> $item)
            @if(!$item->pivot->is_category)
                <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionActShow{{ $key }}" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card border-0 firstUploadCollapse">

                        <!-- Card header -->
                        <div class="card-header bg-white py-3" role="tab">
                            <a data-toggle="collapse" data-parent="#accordionActShow{{ $key }}" href=".collapseActiv{{ $key }}"
                                aria-expanded="true" aria-controls="collapseActiv{{ $key }}">
                                <h5 class="mb-2 ml-1 border-0">
                                    @switch($item->pivot->status)
                                        @case(0)
                                            <img src="{{ asset('images/notSubmited.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="text-primery">(Not Submitted)</small>
                                            @break
                                        @case(1)
                                            <img src="{{ asset('images/pending.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="pending">(Pending Approval)</small>
                                            @break
                                        @case(2)
                                            <img src="{{ asset('images/pending.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="pending">(Pending Approval)</small>
                                            @break
                                        @case(3)
                                            <img src="{{ asset('images/path1.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="text-success">(Approved)</small>
                                            @break
                                        @case(4)
                                            <img src="{{ asset('images/Path-2.png') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="text-danger">(Rejected)</small>
                                            @break
                                        @default
                                            <img src="{{ asset('images/pending.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="pending">(Pending Approval)</small>
                                            @break
                                    @endswitch
                                    <i class="float-right fas fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div class="collapse show borderd border-top-0 collapseActiv{{ $key }}" role="tabpanel" aria-labelledby="headingOne1"
                            data-parent="#accordionActShow{{ $key }}">
                            <div class="card-body">
                                <div class="addDetails p-2">
                                    <div class="container">
                                        <div class="row ">
                                            @php
                                                $parents =  getActivityParents($item->id, [], false, true, true);
                                            @endphp
                                            @foreach ($parents as $chkey => $child)
                                                <div class="col-lg-6 col-md-6 mt-3">
                                                    <div class="compAdd">
                                                        <label>{{ $chkey == 0 ? 'Activity' : 'Sub Activity' }}</label>
                                                        <p class="mt-1">{{ $child->name }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if ($item->code == 'other')
                                                <div class="col-lg-6 col-md-6 mt-3">
                                                    <div class="compAdd">
                                                        <label>Sub Activity</label>
                                                        <p class="mt-1">{{ $item->pivot->other }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach ($item->supplierProjects() as $key => $project)
                                            <div class="col-lg-12 col-12">
                                                <div class="card mt-2">
                                                    <div class="card-header pl-0 py-1">
                                                        <h5 class="pl-0">{{ $numnames[$key]?? $key.'th' }} Projects</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="container">
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label> Company</label>
                                                                        <p class="mt-1">{{ $project->name ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Location</label>
                                                                        <p class="mt-1">{{ $project->country->name??'----' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Phone Number</label>
                                                                        <p class="mt-1">{{ $project->phone ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Project Title</label>
                                                                        <p class="mt-1">{{ $project->project_title ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Project Purpose</label>
                                                                        <p class="mt-1">{{ $project->project_purpos ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Contract Value</label>
                                                                        <p class="mt-1">{{ number_format($project->contract_value) ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Upload Supporting documents</label>
                                                                        @foreach ($project->documents as $Projectfile)
                                                                            <p class="mt-1">{{ $Projectfile->file ?? '-----' }}</p>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Allocated Scope</label>
                                                                        <p class="mt-1">{{ $project->scope ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                                @if ($project->scope == 'part')
                                                                    
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="compAdd">
                                                                            <label>Specify</label>
                                                                            <p class="mt-1">{{ $project->part ?? '-----' }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="compAdd">
                                                                            <label>Awarded Value</label>
                                                                            <p class="mt-1">{{ number_format($project->awarded_value) ?? '-----' }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
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
        @foreach ($user->categories as $key=> $item)
            @if($item->pivot->is_category)
                <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionActShow{{ $key }}" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card border-0 firstUploadCollapse">

                        <!-- Card header -->
                        <div class="card-header bg-white py-3" role="tab">
                            <a data-toggle="collapse" data-parent="#accordionActShow{{ $key }}" href=".collapseActiv{{ $key }}"
                                aria-expanded="true" aria-controls="collapseActiv{{ $key }}">
                                <h5 class="mb-2 ml-1 border-0">
                                    @switch($item->pivot->status)
                                        @case(0)
                                            <img src="{{ asset('images/notSubmited.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="text-primery">(Not Submitted)</small>
                                            @break
                                        @case(1)
                                            <img src="{{ asset('images/pending.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="pending">(Pending Approval)</small>
                                            @break
                                        @case(2)
                                            <img src="{{ asset('images/pending.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="pending">(Pending Approval)</small>
                                            @break
                                        @case(3)
                                            <img src="{{ asset('images/path1.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="text-success">(Approved)</small>
                                            @break
                                        @case(4)
                                            <img src="{{ asset('images/Path-2.png') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="text-danger">(Rejected)</small>
                                            @break
                                        @default
                                            <img src="{{ asset('images/pending.svg') }}" class="imgEdit pr-2">{{ $item->name }}
                                            <small class="pending">(Pending Approval)</small>
                                            @break
                                    @endswitch
                                    <i class="float-right fas fa-angle-down rotate-icon"></i>
                                </h5>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div class="collapse show borderd border-top-0 collapseActiv{{ $key }}" role="tabpanel" aria-labelledby="headingOne1"
                            data-parent="#accordionActShow{{ $key }}">
                            <div class="card-body">
                                <div class="addDetails p-2">
                                    <div class="container">
                                        <div class="row ">
                                            @php
                                                $parents =  getActivityParents($item->activity->id, [], false, true, true);
                                                unset($parents['categories'])
                                            @endphp
                                            @foreach ($parents as $chkey => $child)
                                                <div class="col-lg-6 col-md-6 mt-3">
                                                    <div class="compAdd">
                                                        <label>{{ $chkey == 0 ? 'Activity' : 'Sub Activity' }}</label>
                                                        <p class="mt-1">{{ $child->name }}</p>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="col-lg-6 col-md-6 mt-3">
                                                <div class="compAdd">
                                                    <label>Sub Activity</label>
                                                    <p class="mt-1">{{ $item->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @foreach ($item->supplierProjects() as $key => $project)
                                            <div class="col-lg-12 col-12">
                                                <div class="card mt-2">
                                                    <div class="card-header pl-0 py-1">
                                                        <h5 class="pl-0">{{ $numnames[$key]?? $key.'th' }} Projects</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="container">
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label> Company</label>
                                                                        <p class="mt-1">{{ $project->name ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Location</label>
                                                                        <p class="mt-1">{{ $project->country->name??'----' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Phone Number</label>
                                                                        <p class="mt-1">{{ $project->phone ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Project Title</label>
                                                                        <p class="mt-1">{{ $project->project_title ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Project Purpose</label>
                                                                        <p class="mt-1">{{ $project->project_purpos ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Contract Value</label>
                                                                        <p class="mt-1">{{ number_format($project->contract_value) ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Upload Supporting documents</label>
                                                                        @foreach ($project->documents as $Projectfile)
                                                                            <p class="mt-1">{{ $Projectfile->file ?? '-----' }}</p>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="compAdd">
                                                                        <label>Allocated Scope</label>
                                                                        <p class="mt-1">{{ $project->scope ?? '-----' }}</p>
                                                                    </div>
                                                                </div>
                                                                @if ($project->scope == 'part')
                                                                    
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="compAdd">
                                                                            <label>Specify</label>
                                                                            <p class="mt-1">{{ $project->part ?? '-----' }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6">
                                                                        <div class="compAdd">
                                                                            <label>Awarded Value</label>
                                                                            <p class="mt-1">{{ number_format($project->awarded_value) ?? '-----' }}</p>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
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
        @if ($user->status == 3)
            <p class="text-right"><a href="{{ URL::to('supplier/editdata') }}" class="btn btnSubmit btnEditAct">Edit  Activities </a href="{{ URL::to('supplier/edit') }}"></p>
        @endif

    </div>
