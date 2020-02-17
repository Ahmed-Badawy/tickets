@push('css')
    <style>
        @media screen and (max-width:900px){
            .actCard{
                padding: 0px !important;
            }
            .similerProj{
                padding: 0px !important;
            }
        }
        .bg-scope{
            background-color: #E78C03 !important;
            color: white !important;
        }
    </style>
@endpush

    <div id="activities" class="tab-pane p-0 container {{ $user->expireDocuments() ? 'disableAll':'' }}">


        <form enctype="multipart/form-data" files="true" id="activityForm" method="POST" action="{{ URL::to('supplier/activities') }}" >
            {{ csrf_field() }}
            <div id="activity">
                @if(count($user->activities))
                    @include('supplier.edit.showactivity')
                @else
                    <div class="activityRow">
                        <div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionActivities" role="tablist" aria-multiselectable="true">
                            <!-- Accordion card -->
                            <div class="card border-0 firstUploadCollapse">

                                <!-- Card header -->
                                <div class="card-header pl-0 bg-white " role="tab">
                                    <a data-toggle="collapse" data-parent="#accordionActivities" href=".collapseActivit" aria-expanded="true"
                                        aria-controls="collapseActivit">
                                        <h5 class="mb-2 border-0">
                                            <img src="{{ asset('images/notSubmited.svg') }}" class="imgEdit pr-2">Choose Activity
                                            <small class="text-primery">(Not Submitted)</small>
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

                                                    <div class="col-lg-6 col-md-6 ">
                                                        <div class="form-group">
                                                            <label>Activity</label>
                                                            <select name="parents[]" class="form-control selectactivity" >
                                                                <option disabled selected >Choose Activity</option>
                                                                @foreach ($activities as $activity)
                                                                    <option value="{{ $activity->id }}"> {{ $activity->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="actCard px-5" style="display:none;">
                                                    <div id="activity_0">
                                                        <div class="similerProj ">
                                                            <div class="card mt-2 mb-3">
                                                                <div class="card-header p-1">
                                                                    <h5>Similar Projects (Optional)</h5>
                                                                </div>
                                                                <div class="projectRow">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label> Company </label>
                                                                                    <input type="text" name="activity[0][projectComNames][]" value="" class="form-control" placeholder="Type Your Target Company"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Location</label>
                                                                                    <select name="activity[0][projectlocations][]" class="form-control">
                                                                                            <option disabled selected value="">Choose Country</option>
                                                                                            @foreach (\App\Models\Country::all() as $country)
                                                                                                <option value="{{ $country->id }}"  > {{ $country->name }}</option>
                                                                                            @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Phone Number</label>
                                                                                    <input type="number" name="activity[0][projectphones][]" value="" class="form-control" placeholder="Type Your Telephone Number"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Title</label>
                                                                                    <input type="text" name="activity[0][projecttitls][]" value="" class="form-control" placeholder="Add your Project title"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Project Purpose</label>
                                                                                    <input type="text" name="activity[0][projectpurposes][]" class="form-control" placeholder="Add your Project purpose"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-lg-6 col-md-6 ">
                                                                                <div class="form-group">
                                                                                    <label>Contract Value</label>
                                                                                    <input type="number" step="0.1" name="activity[0][projectcontract_values][]" value="0" class="form-control" placeholder="Add Contract Value"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="col-lg-6 col-md-6">
                                                                                <div class="form-group">
                                                                                    <label>Upload Supporting documents</label>
                                                                                    <input type="file" accept=".pdf" name="activity[0][similarFiles][0][]" data-project="0" data-id="0" class="form-control uploadSimilarFile" placeholder="Add the Awarded Value"
                                                                                        aria-describedby="helpId" >
                                                                                        <div class="editUploadFile mt-4">
                                                                                        </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">

                                                                            <div class="col-lg-6 col-md-6">
                                                                                <label>Allocated Scope</label><br>
                                                                                <input name="activity[0][projectscopes][]" value="all" class="scope" type="hidden">
                                                                                <ul class="list-group list-group-horizontal border-0">
                                                                                    <li class="select1 list-group-item px-5" data-val="all">All</li>
                                                                                    <li class="select2 list-group-item px-5" data-val="part">&nbsp; Part &nbsp;</li>
                                                                                </ul><br>
                                                                            </div>

                                                                            <div class="col-lg-6 col-md-6 specify d-none">
                                                                                <label>Specify</label>
                                                                                <input type="text" name="activity[0][projectparts][]" value="" class="form-control" placeholder="Add Specifies"
                                                                                        aria-describedby="helpId">
                                                                            </div>
                                                                            <div class="col-lg-6 col-md-6 specify d-none">
                                                                                <label>Awarded value</label>
                                                                                <input type="number" name="activity[0][projectawarded_values][]" value="" class="form-control" placeholder="Add Specifies"
                                                                                        aria-describedby="helpId">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="button" onclick="addproject('#activity_0')" class="btn btnClickAddAccount mt-1"><i class="fa fa-plus-circle"></i> Add more projects</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn d-flex justify-content-end text-danger font-weight-bold mr-5 pb-4" onclick="removeactivity(this)">Delete Activity</button>

                            </div>
                            <!-- Accordion card -->
                        </div>
                    </div>
                @endif
            </div>
            <div class="addMore bg-white p-3 mb-4">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-10">
                            <button type="button" onclick="addactivity()" class="btn btnClickAddAccount"><i class="fa fa-plus-circle"></i> Add more activities</button>
                        </div>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btnSubmit float-right mt-4">Save and Continue <i class="fa fa-angle-right"></i></button><br>
        </form>
    </div>
@push('scripts')

    <script>
        let GlobalFiles = [];
        $(document).on("change",".uploadSimilarFile",function(evt){
            let files = evt.target.files;
            let activity_num = $(evt.target).data("id");
            let project_num = $(evt.target).attr("data-project");
            for (let i = 0, file; file = files[i]; i++) {
                if(!GlobalFiles[activity_num] ) {
                    GlobalFiles[activity_num]=[]
                    if( !GlobalFiles[activity_num][project_num])
                        GlobalFiles[activity_num][project_num] = [];
                }
                else{
                    if( !GlobalFiles[activity_num][project_num])
                        GlobalFiles[activity_num][project_num] = [];
                }
                GlobalFiles[activity_num][project_num].push(file);
            }
            let RenderSection = $(evt.target).next(".editUploadFile");
            renderFilesSection(RenderSection, activity_num,project_num );
            $(evt.target).hide();
            $(`<input type="file" accept=".pdf" data-project="`+project_num+`" data-id="`+activity_num+`" name="`+$(evt.target).attr('name')+`" class="form-control uploadSimilarFile" >`).insertAfter($(evt.target));
            // evt.target.files = GlobalFiles;
            // $(evt.target).val(GlobalFiles);
        });
        function renderFilesSection(elm, activity_num, project_num){
            let html = "";
            let fileName = `activity[${activity_num}][similarNames][${project_num}][]`;
            for(let i in GlobalFiles[activity_num][project_num]){
                let file = GlobalFiles[activity_num][project_num][i];
                if(file){
                    let size = (file.size / 1000000).toFixed(1);
                    html += ` <h6>
                            <span>${file.name}</span>
                            <span class="float-right">${size} MB <i class="fa fa-trash-alt text-danger hand deleteFile" data-fileid="${i}" data-activitynum="${activity_num}" data-projectnum="${project_num}"></i></span>
                            <input type="hidden" value="${file.name}" name="${fileName}" />
                        </h6>`;
                }
            }
            elm.html(html);
        }
        $(document).on("click",".deleteFile",function(evt){
            let fileID = $(evt.target).data("fileid");
            let activityNum = $(evt.target).data("activitynum");
            let ProjectNum = $(evt.target).data("projectnum");
            GlobalFiles[activityNum][ProjectNum][fileID] = undefined;
            let renderSection = $(evt.target).parent().parent().parent();
            renderFilesSection( renderSection, activityNum, ProjectNum );
        });

        activitycount = 1;
        $(document).on('change', '.selectactivity', function (event){
            var activityID = $(this).val();
            var select = $(this);
            var that = $(this).parent().parent();
            if(activityID == 'other'){
                while($(that).next('div').length){
                    $(that).next('div').remove();
                }
                html =  `<div class="col-lg-6 col-md-6 ">
                            <div class="form-group">
                                <label>Other</label>
                                <input class="form-control" name="others[]">
                            </div>
                        </div>`;
                $(that).parent().append(html);

                $(that).parent().next().css('display', 'block');
                select.attr('name' ,'activites[]');

            }
            else{
                $.get('{{ URL::to("supplier/getActivity") }}/'+activityID, function(data){
                    while($(that).next('div').length){
                        $(that).next('div').remove();
                    }
                    if(select.attr('name') != 'parents[]'){
                        select.removeAttr('name');
                    }
                    if(data.activites.length > 0){
                        $(that).parent().next().css('display', 'none');
                        html =  '<div class="col-lg-6 col-md-6 ">'+
                                    '<div class="form-group">'+
                                        '<label>'+data.activityName+'</label>';
                                    if(data.parent)
                        html+=          '<select class="form-control selectactivity">';
                                    else
                        html+=          '<select class="form-control" name="activites[]">';
                        html+=              '<option disabled selected >Choose Activity</option>';
                                        for (var i=0; i<data.activites.length; i++)
                        html+=              '<option value="'+data.activites[i].id +'"> '+data.activites[i].name +'</option>';

                        html+=           '</select>'+
                                    '</div>'+
                                '</div>';
                        $(that).parent().append(html);
                    }
                    else{
                        select.attr('name' ,'activites[]');
                    }
                    if(!data.parent){

                        $(that).parent().next().css('display', 'block');
                    }

                })
            }
        })
        function addactivity(){
            let projectsCount = $('.projectRow').length;
            var html =
                        '<div class="activityRow">'+
                            '<div class="accordion border-0 md-accordion mt-5 mb-5" id="accordionActivities'+activitycount+'" role="tablist" aria-multiselectable="true">'+
                                '<div class="card border-0 firstUploadCollapse">'+
                                    '<div class="card-header pl-0 bg-white " role="tab">'+
                                        '<a data-toggle="collapse" data-parent="#accordionActivities'+activitycount+'" href=".collapseActivit'+activitycount+'" aria-expanded="true"'+
                                            'aria-controls="collapseActivit'+activitycount+'">'+
                                            '<h5 class="mb-2 border-0">'+
                                                    '<img src="{{ asset("images/notSubmited.svg") }}" class="mr-4 imgEdit">Choose Activity <small class="text-primery">(Not Submitted)</small>'+
                                                '<i class="float-right fas fa-angle-down rotate-icon"></i>'+
                                            '</h5>'+
                                        '</a>'+
                                    '</div>'+
                                    '<div class="collapse show borderd border-top-0 collapseActivit'+activitycount+'" role="tabpanel" aria-labelledby="headingOne1"'+
                                        'data-parent="#accordionActivities'+activitycount+'">'+
                                        '<div class="card-body">'+
                                            '<div class="addDetails p-2">'+
                                                '<div class="container">'+
                                                    '<div class="row seclectactivityDiv">'+

                                                        '<div class="col-lg-6 col-md-6 ">'+
                                                            '<div class="form-group">'+
                                                                '<label>Activity</label>'+
                                                                '<select name="parents[]" class="form-control selectactivity" >'+
                                                                    '<option disabled selected >Choose Activity</option>'+
                                                                    '@foreach ($activities as $activity)'+
                                                                        '<option value="{{ $activity->id }}"> {{ $activity->name }}</option>'+
                                                                    '@endforeach'+
                                                                '</select>'+
                                                            '</div>'+
                                                        '</div>'+

                                                    '</div>'+
                                                    '<div class="actCard " style="display:none;">'+
                                                        '<div id="activity_'+activitycount+'">'+
                                                            '<div class="similerProj ">'+
                                                                '<div class="card mt-2 mb-3">'+
                                                                    '<div class="card-header p-1">'+
                                                                        '<h5>Similar Projects (Optional)</h5>'+
                                                                    '</div>'+

                                                                    '<div class="projectRow">'+
                                                                        '<div class="card-body">'+
                                                                            '<div class="row">'+
                                                                                '<div class="col-lg-6 col-md-6 ">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label> Company</label>'+
                                                                                        '<input type="text" name="activity['+activitycount+'][projectComNames][]" value="" class="form-control" placeholder="Type Your Target Company"'+
                                                                                            'aria-describedby="helpId">'+
                                                                                    '</div>'+
                                                                                '</div>'+

                                                                                '<div class="col-lg-6 col-md-6 ">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Location</label>'+
                                                                                        '<select name="activity['+activitycount+'][projectlocations][]" class="form-control">'+
                                                                                                '<option disabled selected value="">Choose Country</option>'+
                                                                                                '@foreach (\App\Models\Country::all() as $country)'+
                                                                                                    '<option value="{{ $country->id }}"  > {{ $country->name }}</option>'+
                                                                                                '@endforeach'+
                                                                                        '</select>'+
                                                                                    '</div>'+
                                                                                '</div>'+
                                                                            '</div>'+
                                                                            '<div class="row">'+

                                                                                '<div class="col-lg-6 col-md-6 ">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Phone Number</label>'+
                                                                                        '<input type="number" name="activity['+activitycount+'][projectphones][]" class="form-control" placeholder="Type Your Telephone Number"'+
                                                                                            'aria-describedby="helpId">'+
                                                                                    '</div>'+
                                                                                '</div>'+

                                                                                '<div class="col-lg-6 col-md-6 ">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Project Title</label>'+
                                                                                        '<input type="text" name="activity['+activitycount+'][projecttitls][]" value="" class="form-control" placeholder="Add your Project title"'+
                                                                                            'aria-describedby="helpId">'+
                                                                                    '</div>'+
                                                                                '</div>'+
                                                                            '</div>'+
                                                                            '<div class="row">'+

                                                                                '<div class="col-lg-6 col-md-6 ">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Project Purpose</label>'+
                                                                                        '<input type="text" name="activity['+activitycount+'][projectpurposes][]" class="form-control" placeholder="Add your Project purpose"'+
                                                                                            'aria-describedby="helpId">'+
                                                                                    '</div>'+
                                                                                '</div>'+

                                                                                '<div class="col-lg-6 col-md-6 ">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Contract Value</label>'+
                                                                                        '<input type="number" step="0.1" name="activity['+activitycount+'][projectcontract_values][]" value="0" class="form-control" placeholder="Add the Contract Value" aria-describedby="helpId">'+

                                                                                    '</div>'+
                                                                                '</div>'+
                                                                            '</div>'+
                                                                            '<div class="row">'+

                                                                                '<div class="col-lg-6 col-md-6">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Upload Supporting documents</label>'+
                                                                                        '<input type="file" accept=".pdf" name="activity['+activitycount+'][similarFiles]['+projectsCount+'][]" data-project="'+projectsCount+'" data-id="'+activitycount+'" class="form-control uploadSimilarFile" placeholder="Upload Supporting documents"'+
                                                                                            'aria-describedby="helpId" >'+
                                                                                            '<div class="editUploadFile mt-4">'+
                                                                                            '</div>'+
                                                                                    '</div>'+
                                                                                '</div>'+
                                                                            '</div>'+
                                                                            '<div class="row">'+

                                                                                '<div class="col-lg-6 col-md-6">'+
                                                                                    '<label>Allocated Scope</label><br>'+
                                                                                    '<input name="activity['+activitycount+'][projectscopes][]" value="all" class="scope" type="hidden">'+
                                                                                    '<ul class="list-group list-group-horizontal border-0">'+
                                                                                        '<li class="select1 list-group-item px-5" data-val="all">All</li>'+
                                                                                        '<li class="select2 list-group-item px-5" data-val="part">&nbsp; Part &nbsp;</li>'+
                                                                                    '</ul><br>'+
                                                                                '</div>'+

                                                                                '<div class="col-lg-6 col-md-6 specify d-none">'+
                                                                                    '<label>Specify</label>'+
                                                                                    '<input type="text" name="activity['+activitycount+'][projectparts][]" value="" class="form-control" placeholder="Add Specifies"'+
                                                                                            'aria-describedby="helpId"> '+
                                                                                '</div>'+
                                                                                '<div class="col-lg-6 col-md-6 specify d-none">'+
                                                                                    '<label>Awarded value</label>'+
                                                                                    '<input type="number" step="0.1" name="activity['+activitycount+'][projectawarded_values][]" value="0" class="form-control" placeholder="Add the Awarded Value" aria-describedby="helpId">'+
                                                                                '</div>'+
                                                                            '</div>'+
                                                                        '</div>'+
                                                                    '</div>'+
                                                                '</div>'+
                                                            '</div>'+
                                                        '</div>'+
                                                        '<button type="button" onclick="addproject(\'#activity_'+activitycount+'\')" class="btn btnClickAddAccount mt-1"><i class="fa fa-plus-circle"></i> Add more projects</button>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<button type="button" class="btn d-flex justify-content-end text-danger font-weight-bold mr-5 pb-4" onclick="removeactivity(this)">Delete Activity</button>'+

                                '</div>'+
                            '</div>'+
                        '</div>';

            $('#activity').append(html);
            activitycount ++;

        }
        function removeactivity(e) {
            e.closest('div.activityRow').remove();
        }

        function addproject(DivId){
            var ActivityNum = DivId[DivId.length -1];
            let projectsCount = $('.projectRow').length;

            var html ='<div class="similerProj projectRow ">'+
                            '<div class="card mt-2 mb-3">'+
                                '<div class="card-header p-1">'+
                                    '<h5 class="orderProject_'+ActivityNum+'" >'+ +' Projects <span onclick="removeproject(this, '+ActivityNum+') class="float-right"><img src="{{ asset('images/bin.svg') }}"></span> </h5>'+
                                '</div>'+
                                '<div class="card-body">'+
                                    '<div class="row">'+
                                        '<div class="col-lg-6 col-md-6 ">'+
                                            '<div class="form-group">'+
                                                '<label> Company</label>'+
                                                '<input type="text" name="activity['+ActivityNum+'][projectComNames][]" value="" class="form-control" placeholder="Type Your Target Company" aria-describedby="helpId">'+
                                            '</div>'+
                                        '</div>'+

                                        '<div class="col-lg-6 col-md-6 ">'+
                                            '<div class="form-group">'+
                                                '<label>Location</label>'+
                                                '<select name="activity['+ActivityNum+'][projectlocations][]" class="form-control">'+
                                                        '<option disabled selected value="">Choose Country</option>'+
                                                        '@foreach (\App\Models\Country::all() as $country)'+
                                                            '<option value="{{ $country->id }}" > {{ $country->name }}</option>'+
                                                        '@endforeach'+
                                                '</select>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row">'+
                                        '<div class="col-lg-6 col-md-6 ">'+
                                            '<div class="form-group">'+
                                                '<label>Phone Number</label>'+
                                                '<input type="number" name="activity['+ActivityNum+'][projectphones][]" value="" class="form-control" placeholder="Type Your Telephone Number" aria-describedby="helpId">'+
                                            '</div>'+
                                        '</div>'+

                                        '<div class="col-lg-6 col-md-6 ">'+
                                            '<div class="form-group">'+
                                                '<label>Project Title</label>'+
                                            '<input type="text" name="activity['+ActivityNum+'][projecttitls][]" value="" class="form-control" placeholder="Add your Project title" aria-describedby="helpId">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row">'+
                                        '<div class="col-lg-6 col-md-6 ">'+
                                            '<div class="form-group">'+
                                                '<label>Project Purpose</label>'+
                                                '<input type="text" name="activity['+ActivityNum+'][projectpurposes][]" value="" class="form-control" placeholder="Add your Project purpose" aria-describedby="helpId">'+
                                            '</div>'+
                                        '</div>'+

                                        '<div class="col-lg-6 col-md-6 ">'+
                                            '<div class="form-group">'+
                                                '<label>Contract Value</label>'+
                                                '<input type="number" step="0.1" name="activity['+ActivityNum+'][projectcontract_values][]" value="0" class="form-control" placeholder="Add the Contract Value" aria-describedby="helpId">'+

                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row">'+

                                        '<div class="col-lg-6 col-md-6">'+
                                            '<div class="form-group">'+
                                                '<label>Upload Supporting documents</label>'+
                                                '<input type="file" accept=".pdf" name="activity['+ActivityNum+'][similarFiles]['+projectsCount+'][]" data-project="'+projectsCount+'" data-id="'+ActivityNum+'" class="form-control uploadSimilarFile" placeholder="Upload Supporting documents"'+
                                                    'aria-describedby="helpId" >'+
                                                    '<div class="editUploadFile mt-4">'+
                                                    '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row">'+
                                        '<div class="col-lg-6 col-md-6">'+
                                            '<label>Allocated Scope</label><br>'+
                                            '<input name="activity['+ActivityNum+'][projectscopes][]" value="all" class="scope" type="hidden">'+
                                            '<ul class="list-group list-group-horizontal border-0">'+
                                                '<li class="select1 list-group-item px-5" data-val="all">All</li>'+
                                                '<li class="select2 list-group-item px-5" data-val="part">&nbsp; Part &nbsp;</li>'+
                                           '</ul><br>'+
                                        '</div>'+

                                        '<div class="col-lg-6 col-md-6 specify d-none">'+
                                            '<label>Specify</label>'+
                                            '<input type="text" name="activity['+ActivityNum+'][projectparts][]" value="" class="form-control" placeholder="Add Specifies" aria-describedby="helpId">'+
                                        '</div>'+
                                        '<div class="col-lg-6 col-md-6 specify d-none">'+
                                            '<label>Awarded value</label>'+
                                            '<input type="number" step="0.1" name="activity['+ActivityNum+'][projectawarded_values][]" value="0" class="form-control" placeholder="Add the Awarded Value" aria-describedby="helpId">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
            $(DivId).append(html);
            addordernumber(document.getElementsByClassName('orderProject_'+ActivityNum), ' Project', 'removeproject(this, '+ActivityNum+')');

        }

        function removeproject(e, ActivityNum){
            e.closest('div.projectRow').remove();
            addordernumber(document.getElementsByClassName('orderProject_'+ActivityNum), ' Project', 'removeproject(this, '+ActivityNum+')');

        }

        // $('#activityForm')
        // .ajaxForm({
        //     url : $('#activityForm').attr('action'), // or whatever
        //     type : $('#activityForm').attr('method'), // or whatever
        //     dataType : 'json',
        //     success : function (response) {
        //         if(response.success){
        //             $('a[href="#uploadDocuments"]').click();
        //             // window.location.hash = 'branches';
        //             window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
        //         }
        //         else{
        //         }
        //     },
        //     error: function (response){
        //     }
        // });


    </script>

    <script>
        let activateLink = evt=>{
            let parent = $(evt.target).parent().parent().next();
            let input = $(evt.target).parent().prev();
            $(evt.target).parent().find(".bg-scope").removeClass("bg-scope");
            $(evt.target).addClass("bg-scope");
            $(evt.target).parent().prev().val($(evt.target).attr('data-val'));
        }
        $(document).on('click','.select1',function(evt){
            let parent = $(evt.target).parent().parent().next();
            parent.addClass('d-none');
            parent.next().addClass('d-none');
            activateLink(evt);
        });
        $(document).on('click','.select2', function(evt){
            let parent = $(evt.target).parent().parent().next();
            parent.removeClass('d-none');
            parent.next().removeClass('d-none');

            activateLink(evt);
        });
    </script>
@endpush
