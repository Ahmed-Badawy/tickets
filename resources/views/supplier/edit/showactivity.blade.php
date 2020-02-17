@foreach ($user->activities as $key=> $item)
    @if(!$item->pivot->is_category && $item->pivot->status == 3)
        <div class="activityRow disableAll">
            <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionActivities" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">
            
                    <!-- Card header -->
                    <div class="card-header pl-0 bg-white" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionActivities" href=".collapseActivit" aria-expanded="true"
                            aria-controls="collapseActivit">
                            <h5 class="mb-2 border-0">
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
                    
                    <div class="collapse show borderd border-top-0 collapseActivit" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionActivities">
                        <div class="card-body">
                            <div class="addDetails p-2">
                                <div class="container">
                                    
                                    <div class="row seclectactivityDiv">
                                        @php
                                        $parents =  getActivityParents($item->id, [], false, true, true);
                                        
                                        @endphp
                                        @foreach ($parents as $activKey =>$activityItem)
                                            @php
                                                $childrens = $activityItem->parent->children ??$activities;
                                            @endphp    
                                            @if ($activKey < (count($parents) -1))
                                                <div class="col-lg-6 col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Activity</label>
                                                        <select class="form-control selectactivity"  >
                                                            <option disabled selected >Choose Activity</option>
                                                            
                                                            @foreach ($childrens as $activity)
                                                                <option value="{{ $activity->id }}" {{ ($activityItem->id == $activity->id) ? 'selected':'' }}> {{ $activity->name }}</option>
                                                            @endforeach
                                                            @if ($activKey == 0)
                                                                <option value="other" {{ ($activityItem->code == 'other') ? 'selected':'' }}>Other</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Activity</label>
                                                        <select  class="form-control selectactivity" >
                                                            <option disabled selected >Choose Activity</option>
                                                            @foreach ($childrens as $activity)
                                                                <option value="{{ $activity->id }}" {{ ($activityItem->id == $activity->id) ? 'selected':'' }}> {{ $activity->name }}</option>
                                                            @endforeach
                                                            @if ($activKey == 0)
                                                                <option value="other" {{ ($activityItem->code == 'other') ? 'selected':'' }}>Other</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif 
                                            @if ($activityItem->code == 'other')
                                                <div class="col-lg-6 col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Activity</label>
                                                        <input  class="form-control " value="{{ $item->pivot->other }}">
                                                            
                                                    </div>
                                                </div>
                                            @endif   
                                        @endforeach
                                        
                                    </div>
                                    <div class="actCard" >
                                        <div >
                                            @if(count($item->supplierProjects()))
                                                @foreach ($item->supplierProjects() as $projectkey =>$project)
                                                    @if ($projectkey == 0)
                                                        <div class="similerProj">
                                                            <div class="card mt-2 mb-3">
                                                                <div class="card-header p-1">
                                                                    <h5>Similar Projects (Optional)</h5>
                                                                </div>
                                                                <div class="projectRow">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label> Company</label>
                                                                                    <input type="text" value="{{ $project->name }}"  class="form-control" placeholder="Type Your Target Company"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Location</label>
                                                                                    <select  class="form-control">
                                                                                            <option disabled selected value="">Choose Country</option>
                                                                                            @foreach (\App\Models\Country::all() as $country)
                                                                                                <option value="{{ $country->id }}"  {{ ($project->location == $country->id)? 'selected' :'' }}> {{ $country->name }}</option>
                                                                                            @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Phone Number</label>
                                                                                    <input type="number" value="{{ $project->phone }}" class="form-control" placeholder="Type Your Telephone Number"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Title</label>
                                                                                    <input type="text" value="{{ $project->project_title }}" class="form-control" placeholder="Add your Project title"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Purpose</label>
                                                                                    <input type="text" value="{{ $project->project_purpos }}" class="form-control" placeholder="Add your Project purpose"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Awarded Value</label>
                                                                                    <input type="number" step="0.1" value="{{ $project->awarded_value }}"  class="form-control" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Upload Supporting documents</label>
                                                                                    <input type="file" value="{{ $project->file }}"  class="form-control" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId">
                                                                                    <div class="editUploadFile mt-4">
                                                                                        @foreach ($project->documents as $filekey => $Projectfile)
                                                                                            <h6>
                                                                                                <span>{{ $Projectfile->file }}</span>
                                                                                                <span class="float-right"> {{ human_filesize($Projectfile->file) }} 
                                                                                                </span>
                                                                                            </h6>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6">
                                                                                <label>Allocated Scope</label><br>
                                                                                <input value="{{ $project->scope }}" class="scope" type="hidden">
                                                                                <ul class="list-group list-group-horizontal border-0">
                                                                                    <li class=" list-group-item px-5 {{ ($project->scope =='all')? 'bg-scope':'' }}" data-val="all">All</li>
                                                                                    <li class=" list-group-item px-5 {{ ($project->scope =='part')? 'bg-scope':'' }}" data-val="part">&nbsp; Part &nbsp;</li>
                                                                                </ul><br>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 specify {{ ($project->scope =='all')? 'd-none':'' }}">
                                                                            <label>Specify</label>
                                                                            <input value="{{ $project->part }}" type="text" class="form-control" placeholder="Add Specifies"
                                                                                        aria-describedby="helpId"> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="similerProj projectRow">
                                                            <div class="card mt-2 mb-3">
                                                                <div class="card-header p-1">
                                                                    <h5 >{{ $numnames[$projectkey] }} Project </h5>
                                                                </div>
                                                                <div class="projectRow">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label> Company</label>
                                                                                    <input type="text" value="{{ $project->name }}"  class="form-control" placeholder="Type Your Target Company"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Location</label>
                                                                                    <select  class="form-control">
                                                                                            <option disabled selected value="">Choose Country</option>
                                                                                            @foreach (\App\Models\Country::all() as $country)
                                                                                                <option value="{{ $country->id }}"  {{ ($project->location == $country->id)? 'selected' :'' }}> {{ $country->name }}</option>
                                                                                            @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Phone Number</label>
                                                                                    <input type="number" value="{{ $project->phone }}" class="form-control" placeholder="Type Your Telephone Number"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Title</label>
                                                                                    <input type="text" value="{{ $project->project_title }}" class="form-control" placeholder="Add your Project title"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Purpose</label>
                                                                                    <input type="text" value="{{ $project->project_purpos }}" class="form-control" placeholder="Add your Project purpose"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Awarded Value</label>
                                                                                    <input type="number" step="0.1" value="{{ $project->awarded_value }}"  class="form-control" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Upload Supporting documents</label>
                                                                                    <input type="file" value="{{ $project->file }}"  class="form-control" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId">
                                                                                    <div class="editUploadFile mt-4">
                                                                                        @foreach ($project->documents as $filekey => $Projectfile)
                                                                                            <h6>
                                                                                                <span>{{ $Projectfile->file }}</span>
                                                                                                <span class="float-right"> {{ human_filesize($Projectfile->file) }} 
                                                                                                </span>
                                                                                            </h6>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6">
                                                                                <label>Allocated Scope</label><br>
                                                                                <input value="{{ $project->scope }}" class="scope" type="hidden">
                                                                                <ul class="list-group list-group-horizontal border-0">
                                                                                    <li class=" list-group-item px-5 {{ ($project->scope =='all')? 'bg-scope':'' }}" data-val="all">All</li>
                                                                                    <li class=" list-group-item px-5 {{ ($project->scope =='part')? 'bg-scope':'' }}" data-val="part">&nbsp; Part &nbsp;</li>
                                                                                </ul><br>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 specify {{ ($project->scope =='all')? 'd-none':'' }}">
                                                                            <label>Specify</label>
                                                                            <input value="{{ $project->part }}" type="text" class="form-control" placeholder="Add Specifies"
                                                                                        aria-describedby="helpId"> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                            <div class="similerProj">
                                                <div class="card mt-2 mb-3">
                                                    <div class="card-header p-1">
                                                        <h5>Similar Projects (Optional)</h5>
                                                    </div>
                                                    <div class="projectRow">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label> Company</label>
                                                                        <input type="text"   class="form-control" placeholder="Type Your Target Company"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Location</label>
                                                                        <select class="form-control">
                                                                                <option disabled selected value="">Choose Country</option>
                                                                                @foreach (\App\Models\Country::all() as $country)
                                                                                    <option value="{{ $country->id }}"   > {{ $country->name }}</option>
                                                                                @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Phone Number</label>
                                                                        <input type="number"   class="form-control" placeholder="Type Your Telephone Number"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Project Title</label>
                                                                        <input type="text"   class="form-control" placeholder="Add your Project title"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Project Purpose</label>
                                                                        <input type="text"  class="form-control" placeholder="Add your Project purpose"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Awarded Value</label>
                                                                        <input type="number" step="0.1"  class="form-control" placeholder="Add the Awarded Value"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Upload Supporting documents</label>
                                                                        <input type="file" class="form-control" placeholder="Add the Awarded Value"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-6 col-md-6">
                                                                    <label>Allocated Scope</label><br>
                                                                    <input  class="scope" type="hidden">
                                                                    <ul class="list-group list-group-horizontal border-0">
                                                                        <li class=" list-group-item px-5 " data-val="all">All</li>
                                                                        <li class=" list-group-item px-5 " data-val="part">&nbsp; Part &nbsp;</li>
                                                                    </ul><br>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 specify d-none">
                                                                <label>Specify</label>
                                                                <input type="text" class="form-control" placeholder="Add Specifies"
                                                                            aria-describedby="helpId"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                <!-- Accordion card -->

            </div>
        </div>
    @elseif($item->pivot->is_category && $item->pivot->status == 3)
        <div class="activityRow disableAll">
            <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionActivities" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">
            
                    <!-- Card header -->
                    <div class="card-header pl-0 bg-white" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionActivities" href=".collapseActivit" aria-expanded="true"
                            aria-controls="collapseActivit">
                            <h5 class="mb-2 border-0">
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
                    
                    <div class="collapse show borderd border-top-0 collapseActivit" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionActivities">
                        <div class="card-body">
                            <div class="addDetails p-2">
                                <div class="container">
                                    
                                    <div class="row seclectactivityDiv">
                                        @php
                                            $parents =  getActivityParents($user->getcatActivityID($item->id), [], false, true, true);
                                            unset($parents['categories'])
                                        @endphp
                                        
                                        @foreach ($parents as $activKey =>$activityItem)
                                            @php
                                                $childrens = $activityItem->parent->children ??$activities;
                                            @endphp    
                                                <div class="col-lg-6 col-md-6 ">
                                                    <div class="form-group">
                                                        <label>Activity</label>
                                                        <select class="form-control selectactivity"  >
                                                            <option disabled selected >Choose Activity</option>
                                                            
                                                            @foreach ($childrens as $activity)
                                                                <option value="{{ $activity->id }}" {{ ($activityItem->id == $activity->id) ? 'selected':'' }}> {{ $activity->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                        @endforeach
                                        @php
                                            $childrens = $user->getcatActivityID($item->id, true) ??$activities;
                                        @endphp  
                                        <div class="col-lg-6 col-md-6 ">
                                            <div class="form-group">
                                                <label>Activity</label>
                                                <select class="form-control selectactivity" >
                                                    <option disabled selected >Choose Activity</option>
                                                    @foreach ($childrens as $activity)
                                                        <option value="{{ $activity->id }}" {{ ($item->id == $activity->id) ? 'selected':'' }}> {{ $activity->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="actCard" >
                                        <div >
                                            @if(count($item->supplierProjects()))
                                                @foreach ($item->supplierProjects() as $projectkey =>$project)
                                                    @if ($projectkey == 0)
                                                        <div class="similerProj">
                                                            <div class="card mt-2 mb-3">
                                                                <div class="card-header p-1">
                                                                    <h5>Similar Projects (Optional)</h5>
                                                                </div>
                                                                <div class="projectRow">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label> Company</label>
                                                                                    <input type="text" value="{{ $project->name }}" class="form-control" placeholder="Type Your Target Company"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Location</label>
                                                                                    <select  class="form-control">
                                                                                            <option disabled selected value="">Choose Country</option>
                                                                                            @foreach (\App\Models\Country::all() as $country)
                                                                                                <option value="{{ $country->id }}"  {{ ($project->location == $country->id)? 'selected' :'' }}> {{ $country->name }}</option>
                                                                                            @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Phone Number</label>
                                                                                    <input type="number" value="{{ $project->phone }}"  class="form-control" placeholder="Type Your Telephone Number"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Title</label>
                                                                                    <input type="text" value="{{ $project->project_title }}"  class="form-control" placeholder="Add your Project title"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Purpose</label>
                                                                                    <input type="text" value="{{ $project->project_purpos }}"  class="form-control" placeholder="Add your Project purpose"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Awarded Value</label>
                                                                                    <input type="number" step="0.1" value="{{ $project->awarded_value }}" class="form-control" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Upload Supporting documents</label>
                                                                                    <input type="file" value="{{ $project->file }}" class="form-control" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId">
                                                                                    <div class="editUploadFile mt-4">
                                                                                        @foreach ($project->documents as $filekey => $Projectfile)
                                                                                            <h6>
                                                                                                <span>{{ $Projectfile->file }}</span>
                                                                                                <span class="float-right"> {{ human_filesize($Projectfile->file) }} 
                                                                                                </span>
                                                                                            </h6>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6">
                                                                                <label>Allocated Scope</label><br>
                                                                                <input value="{{ $project->scope }}"  class="scope" type="hidden">
                                                                                <ul class="list-group list-group-horizontal border-0">
                                                                                    <li class=" list-group-item px-5 {{ ($project->scope =='all')? 'bg-scope':'' }}" data-val="all">All</li>
                                                                                    <li class=" list-group-item px-5 {{ ($project->scope =='part')? 'bg-scope':'' }}" data-val="part">&nbsp; Part &nbsp;</li>
                                                                                </ul><br>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 specify {{ ($project->scope =='all')? 'd-none':'' }}">
                                                                            <label>Specify</label>
                                                                            <input value="{{ $project->part }}" type="text"  class="form-control" placeholder="Add Specifies"
                                                                                        aria-describedby="helpId"> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="similerProj projectRow">
                                                            <div class="card mt-2 mb-3">
                                                                <div class="card-header p-1">
                                                                    <h5 > {{ $numnames[$projectkey] }} Project </h5>
                                                                </div>
                                                                <div class="projectRow">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label> Company</label>
                                                                                    <input type="text" value="{{ $project->name }}" class="form-control" placeholder="Type Your Target Company"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Location</label>
                                                                                    <select  class="form-control">
                                                                                            <option disabled selected value="">Choose Country</option>
                                                                                            @foreach (\App\Models\Country::all() as $country)
                                                                                                <option value="{{ $country->id }}"  {{ ($project->location == $country->id)? 'selected' :'' }}> {{ $country->name }}</option>
                                                                                            @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Phone Number</label>
                                                                                    <input type="number" value="{{ $project->phone }}"  class="form-control" placeholder="Type Your Telephone Number"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Title</label>
                                                                                    <input type="text" value="{{ $project->project_title }}"  class="form-control" placeholder="Add your Project title"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Purpose</label>
                                                                                    <input type="text" value="{{ $project->project_purpos }}"  class="form-control" placeholder="Add your Project purpose"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Awarded Value</label>
                                                                                    <input type="number" step="0.1" value="{{ $project->awarded_value }}" class="form-control" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Upload Supporting documents</label>
                                                                                    <input type="file" value="{{ $project->file }}" class="form-control" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId">
                                                                                    <div class="editUploadFile mt-4">
                                                                                        @foreach ($project->documents as $filekey => $Projectfile)
                                                                                            <h6>
                                                                                                <span>{{ $Projectfile->file }}</span>
                                                                                                <span class="float-right"> {{ human_filesize($Projectfile->file) }} 
                                                                                                </span>
                                                                                            </h6>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            
                                                                            <div class="col-lg-6 col-md-6">
                                                                                <label>Allocated Scope</label><br>
                                                                                <input value="{{ $project->scope }}"  class="scope" type="hidden">
                                                                                <ul class="list-group list-group-horizontal border-0">
                                                                                    <li class=" list-group-item px-5 {{ ($project->scope =='all')? 'bg-scope':'' }}" data-val="all">All</li>
                                                                                    <li class=" list-group-item px-5 {{ ($project->scope =='part')? 'bg-scope':'' }}" data-val="part">&nbsp; Part &nbsp;</li>
                                                                                </ul><br>
                                                                            </div>
                                                                            
                                                                            <div class="col-lg-6 col-md-6 specify {{ ($project->scope =='all')? 'd-none':'' }}">
                                                                            <label>Specify</label>
                                                                            <input value="{{ $project->part }}" type="text"  class="form-control" placeholder="Add Specifies"
                                                                                        aria-describedby="helpId"> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                            <div class="similerProj">
                                                <div class="card mt-2 mb-3">
                                                    <div class="card-header p-1">
                                                        <h5>Similar Projects (Optional)</h5>
                                                    </div>
                                                    <div class="projectRow">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label> Company</label>
                                                                        <input type="text" class="form-control" placeholder="Type Your Target Company"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Location</label>
                                                                        <select class="form-control">
                                                                                <option disabled selected value="">Choose Country</option>
                                                                                @foreach (\App\Models\Country::all() as $country)
                                                                                    <option value="{{ $country->id }}"   > {{ $country->name }}</option>
                                                                                @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Phone Number</label>
                                                                        <input type="number" class="form-control" placeholder="Type Your Telephone Number"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Project Title</label>
                                                                        <input type="text" class="form-control" placeholder="Add your Project title"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Project Purpose</label>
                                                                        <input type="text"  class="form-control" placeholder="Add your Project purpose"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 ">
                                                                    <div class="form-group">
                                                                        <label>Awarded Value</label>
                                                                        <input type="number" step="0.1"  class="form-control" placeholder="Add the Awarded Value"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Upload Supporting documents</label>
                                                                        <input type="file" class="form-control" placeholder="Add the Awarded Value"
                                                                            aria-describedby="helpId">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                
                                                                <div class="col-lg-6 col-md-6">
                                                                    <label>Allocated Scope</label><br>
                                                                    <input class="scope" type="hidden">
                                                                    <ul class="list-group list-group-horizontal border-0">
                                                                        <li class=" list-group-item px-5 " data-val="all">All</li>
                                                                        <li class=" list-group-item px-5 " data-val="part">&nbsp; Part &nbsp;</li>
                                                                    </ul><br>
                                                                </div>
                                                                
                                                                <div class="col-lg-6 col-md-6 specify d-none">
                                                                <label>Specify</label>
                                                                <input  type="text" class="form-control" placeholder="Add Specifies"
                                                                            aria-describedby="helpId"> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <script>
                                                addordernumber(document.getElementsByClassName('orderProject_{{ $key }}'), ' Project', 'removeproject(this, {{ $key }})');
                                            </script>
                                        </div>
                                    </div>
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
                <!-- Accordion card -->

            </div>
        </div>
    @endif
@endforeach
@include('supplier.registers.showactivity')
