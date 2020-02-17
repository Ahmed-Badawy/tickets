
    <div id="branches" class="tab-pane p-0 container {{ $user->expireDocuments() ? 'disableAll':'' }}">
        <form method="POST" id="branchform" action="{{ URL::to('supplier/branches') }}" style="width: -webkit-fill-available;">
            {{ csrf_field() }}
            <div class="accordion md-accordion mt-5 mb-5" id="accordionBank" role="tablist" aria-multiselectable="true">
                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">

                    <!-- Card header -->
                    <div class="card-header bg-white p-3" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionBank" href=".collapseBank" aria-expanded="true"
                            aria-controls="collapseBank">
                            <h5 class="mb-2 px-0 border-bottom-0">
                                Branches Information
                                <i class="float-right fas fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div class="collapse show borderd border-top-0 collapseBank" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionBank">
                        <div class="card-body">
                            <div class="addDetails p-2">
                                <div class="container">
                                    @if(count($user->branches))
                                        @foreach ($user->branches as $key => $branch)
                                            @if ($key == 0)
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Name</label><span class="float-right"><small>(Optional)</small></span>
                                                            <input type="text" value="{{ $branch->name }}" name="names[]" class="form-control" placeholder="Add the name"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                        <i class="far fa-question-circle"></i></span>
                                                            <input type="text" value="{{ $branch->address }}" name="addresses[]" class="form-control" placeholder="Add your address"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select type="text" class="country_id form-control " name="country_id[]">
                                                                <option disabled selected value="">Choose Country</option>
                                                                @foreach (\App\Models\Country::all() as $country)
                                                                    <option value="{{ $country->id }}" {{ $branch->country_id == $country->id ? 'selected' :'' }}> {{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <select type="text" name="city_id[]" class="city_id form-control ">
                                                                <option disabled selected value="">Choose City</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Email Address</label>
                                                            <input type="email" value="{{ $branch->email }}" name="emails[]" class="form-control" placeholder="Add the email"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                                            <input type="number" value="{{ $branch->fax }}" name="faxes[]" class="form-control" placeholder="Add fax number"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @if ($key == 1)
                                                    <div id="branchDiv">
                                                @endif
                                                    <div class="row branchRow">
                                                        <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                                            <div class="card mt-2">
                                                                <div class="card-header p-1">
                                                                    <h5 class="pl-2 orderbranch" onclick="removebranch(this)"><span class="float-right"><img src="{{ asset('images/bin.svg') }}"></span></h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="container">
                                                                        <div class="row">
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Name</label><span class="float-right"><small>(Optional)</small></span>
                                                                                    <input type="text" value="{{ $branch->name }}" name="names[]" class="form-control" placeholder="Add the name"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                                                    <i class="far fa-question-circle"></i></span>
                                                                                    <input type="text" value="{{ $branch->address }}" name="addresses[]" class="form-control" placeholder="Add your address"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Country</label>
                                                                                    <select type="text" class="country_id form-control " name="country_id[]">
                                                                                        <option disabled selected value="">Choose Country</option>
                                                                                        @foreach (\App\Models\Country::all() as $country)
                                                                                            <option value="{{ $country->id }}" {{ $branch->country_id == $country->id ? 'selected' :'' }}> {{ $country->name }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>City</label>
                                                                                    <select type="text" name="city_id[]" class="city_id form-control ">
                                                                                        <option disabled selected value="">Choose City</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Email Address</label>
                                                                                    <input type="email" value="{{ $branch->email }}" name="emails[]" class="form-control" placeholder="Add the email"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                <div class="form-group">
                                                                                    <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                                                                    <input type="number" value="{{ $branch->fax }}" name="faxes[]" class="form-control" placeholder="Add fax number"
                                                                                        aria-describedby="helpId">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if ($key == count($user->branches) -1)
                                                    </div>
                                                    @endif
                                            @endif
                                        @endforeach
                                        @if (count($user->branches) == 1)
                                            <div id="branchDiv">

                                            </div>
                                        @endif
                                    @else
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Name</label><span class="float-right"><small>(Optional)</small></span>
                                                    <input type="text"  name="names[]" class="form-control" placeholder="Add the name"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input type="text" name="addresses[]" class="form-control" placeholder="Add your address"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select type="text" class="country_id form-control " name="country_id[]">
                                                        <option disabled selected value="">Choose Country</option>
                                                        @foreach (\App\Models\Country::all() as $country)
                                                            <option value="{{ $country->id }}" > {{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select type="text" name="city_id[]" class="city_id form-control ">
                                                        <option disabled selected value="">Choose City</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" name="emails[]" class="form-control" placeholder="Add the email"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                                    <input type="number" name="faxes[]" class="form-control" placeholder="Add fax number"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="branchDiv">

                                        </div>
                                    @endif



                                    <div class="row">
                                        <div class="col-lg-7 linkAdd">
                                            <button type="button" onclick="addbranch()" class="mt-3 btnClickAddAccount border-0 bg-white"><i class="fa fa-plus-circle"></i> &nbsp; Add more branches</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Accordion card -->
            </div><br>

            <button type="submit" class="btn btnSubmit float-right mb-2">Save and Continue <i class="fa fa-angle-right"></i></button><br>
        </form>
    </div>
@push('scripts')

<script>

    $(document).on('change', '.country_id', function(e){
        var id = $(this).val();
        var that = $(this);
        var citySelect = that.parent().parent().next().children().children()[1];
        $.get('{{ URL::to("supplier/getcities") }}/' + id, function(data){
            if(Array.isArray(data.result)){
                $(citySelect).html('');
                $.each(data.result, function( index, value ) {
                    $(citySelect).append('<option value="'+value.id+'">'+ value.name +'</option>');
                });
            }
        });
    });
    function addbranch(){
        var html = `
                    <div class="row branchRow">
                        <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                            <div class="card mt-2">
                                <div class="card-header p-1">
                                    <h5 class="pl-2 orderbranch" "><span onclick="removebranch(this) class="float-right"><img src="{{ asset('images/bin.svg') }}"></span></h5>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Name</label><span class="float-right"><small>(Optional)</small></span>
                                                    <input type="text"  name="names[]" class="form-control" placeholder="Add the name"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Address</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                        <i class="far fa-question-circle"></i></span>
                                                    <input type="text"  name="addresses[]" class="form-control" placeholder="Add your address"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select type="text" class="country_id form-control " name="country_id[]">
                                                        <option disabled selected value="">Choose Country</option>
                                                        @foreach (\App\Models\Country::all() as $country)
                                                            <option value="{{ $country->id }}" > {{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <select type="text" name="city_id[]" class="city_id form-control ">
                                                        <option disabled selected value="">Choose City</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email"  name="emails[]" class="form-control" placeholder="Add the email"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Fax Number</label><span class="float-right"><small>(Optional)</small></span>
                                                    <input type="number" name="faxes[]" class="form-control" placeholder="Add fax number"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
        $('#branchDiv').append(html);
        addordernumber(document.getElementsByClassName("orderbranch"), 'Branch', "removebranch(this)");

    }
    $(document).on('click', '#editbarnch', function(event){
        $('#addbranchrow').css('display', 'block');
    });
    function removebranch(e){
        e.closest('div.branchRow').remove();
        addordernumber(document.getElementsByClassName("orderbranch"), 'Branch', "removebranch(this)");

    }


</script>
@endpush
