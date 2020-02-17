
    <div id="bankAcc" class="tab-pane p-0 container {{ $user->expireDocuments() ? 'disableAll':'' }}">
        <form method="POST" id="bankform" action="{{ URL::to('supplier/banks') }}" style="width: -webkit-fill-available;">
            {{ csrf_field() }}

            <div class="accordion md-accordion mt-5 mb-5" id="accordionBank" role="tablist" aria-multiselectable="true">

                <!-- Accordion card -->
                <div class="card border-0 firstUploadCollapse">

                    <!-- Card header -->
                    <div class="card-header bg-white p-3" role="tab">
                        <a data-toggle="collapse" data-parent="#accordionBank" href=".collapseBank" aria-expanded="true"
                            aria-controls="collapseBank">
                            <h5 class="mb-2 px-0 border-bottom-0">
                                Bank Infomation
                                <i class="float-right fas fa-angle-down rotate-icon"></i>
                            </h5>
                        </a>
                    </div>

                    <!-- Card body -->
                    <div class="collapse show borderd border-top-0 collapseBank" role="tabpanel" aria-labelledby="headingOne1"
                        data-parent="#accordionBank">
                        <div class="card-body">
                            <div class="addDetails py-2 px-3">
                                <div class="container">
                                    @if(count($user->banks))
                                        @foreach ($user->banks as $key =>$bank)
                                            @if ($key == 0)
                                                <div class="row">

                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Name</label><span class="float-right" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="Hover over the buttons below to see the directions">
                                                        <i class="far fa-question-circle"></i></span>
                                                            <input type="text" value="{{ $bank->bank_name }}" name="bank_names[]" class="form-control" placeholder="Add your company bank"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Abbreviation</label><span class="float-right"><small>(Optional)</small></span>
                                                            <input type="text" value="{{ $bank->abbreviation }}" name="bank_abbreviation[]" class="form-control" placeholder="e.g CIB"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>SWIFT Code</label><span class="float-right"><small>(Optional)</small></span>
                                                            <input type="text" value="{{ $bank->swift_code }}" name="bank_swift_code[]" class="form-control" placeholder="Add your bank swift code"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>IBAN Code</label><span class="float-right"><small>(Optional)</small></span>
                                                            <input type="text" value="{{ $bank->iban_code }}" name="bank_iban_code[]" class="form-control" placeholder="Add bank iban code"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">

                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select class="form-control " name="bank_country[]">
                                                                <option disabled selected value="">Choose Country</option>
                                                                @foreach (\App\Models\Country::all() as $country)
                                                                    <option value="{{ $country->id }}" {{ ($bank->country_id ==$country->id) ? 'selected':'' }}> {{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Account Number</label>
                                                            <input type="number" value="{{ $bank->account_number }}" name="bank_account_number[]" class="form-control" placeholder="Add your account number"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Currency</label>
                                                            <select class="form-control" name="currency[]">
                                                                @include('supplier.registers.currency',['currencyValue'=>$bank->currency])
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @if ($key == 1)
                                                    <div id="bankDiv">
                                                @endif
                                                        <div class="row bankRow">
                                                            <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                                                <div class="card mt-2">
                                                                    <div class="card-header p-1">
                                                                        <h5 class="pl-2 orderbank" onclick="removebank(this)"><span class="float-right"><img src="{{ asset('images/bin.svg') }}"></span></h5>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        <div class="container">
                                                                            <div class="row">
                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>Name</label>
                                                                                        <input type="text" value="{{ $bank->bank_name }}" name="bank_names[]" class="form-control" placeholder="Add your company bank"
                                                                                            aria-describedby="helpId">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>Abbreviation</label><span class="float-right"><small>(Optional)</small></span>
                                                                                        <input type="text" value="{{ $bank->abbreviation }}" name="bank_abbreviation[]" class="form-control" placeholder="e.g CIB"
                                                                                            aria-describedby="helpId">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">

                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>SWIFT Code</label><span class="float-right"><small>(Optional)</small></span>
                                                                                        <input type="text" value="{{ $bank->swift_code }}" name="bank_swift_code[]" class="form-control" placeholder="Add your bank swift code"
                                                                                            aria-describedby="helpId">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>IBAN Code</label><span class="float-right"><small>(Optional)</small></span>
                                                                                        <input type="text" value="{{ $bank->iban_code }}" name="bank_iban_code[]" class="form-control" placeholder="Add bank iban code"
                                                                                            aria-describedby="helpId">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">

                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>Country</label>
                                                                                        <select class="form-control " name="bank_country[]">
                                                                                            <option disabled selected value="">Choose Country</option>
                                                                                            @foreach (\App\Models\Country::all() as $country)
                                                                                                <option value="{{ $country->id }}" {{ ($bank->country_id ==$country->id) ? 'selected':'' }}> {{ $country->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>Account Number</label>
                                                                                        <input type="number" value="{{ $bank->account_number }}" name="bank_account_number[]" class="form-control" placeholder="Add your account number"
                                                                                            aria-describedby="helpId">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                                                    <div class="form-group">
                                                                                        <label>Currency</label>
                                                                                        <select class="form-control" name="currency[]">
                                                                                            @include('supplier.registers.currency', ['currencyValue'=>$bank->currency])
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @if ($key == count($user->banks) - 1)
                                                    </div>
                                                @endif
                                            @endif

                                        @endforeach
                                        @if (count($user->banks) == 1)
                                            <div id="bankDiv">

                                            </div>
                                        @endif
                                    @else
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="bank_names[]" class="form-control" placeholder="Add your company bank"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Abbreviation</label><span class="float-right"><small>(Optional)</small></span>
                                                    <input type="text" name="bank_abbreviation[]" class="form-control" placeholder="e.g CIB"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>SWIFT Code</label><span class="float-right"><small>(Optional)</small></span>
                                                    <input type="text" name="bank_swift_code[]" class="form-control" placeholder="Add your bank swift code"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>IBAN Code</label><span class="float-right"><small>(Optional)</small></span>
                                                    <input type="text" name="bank_iban_code[]" class="form-control" placeholder="Add bank iban code"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Country</label>
                                                    <select class="form-control " name="bank_country[]">
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
                                                    <label>Account Number</label>
                                                    <input type="number" name="bank_account_number[]" class="form-control" placeholder="Add your account number"
                                                        aria-describedby="helpId">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                <div class="form-group">
                                                    <label>Currency</label>
                                                    <select class="form-control" name="currency[]">
                                                        @include('supplier.registers.currency',['currencyValue'=>''])
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="bankDiv">
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-7 linkAdd">
                                            <button type="button" onclick="addbank()" class="mt-3 btnClickAddAccount border-0 bg-white"><i class="fa fa-plus-circle"></i> &nbsp; Add more accounts</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Accordion card -->
            </div>

            <button type="submit" class="btn btnSubmit float-right mb-2">Save and Continue <i class="fa fa-angle-right"></i></button><br>
        </form>
    </div>

@push('scripts')
    <script>
        $('#bankform')
        .ajaxForm({
            url : $('#bankform').attr('action'), // or whatever
            type : $('#bankform').attr('method'), // or whatever
            dataType : 'json',
            success : function (response) {
                if(response.success){
                    $('#flash-container').css('display','block');
                    setTimeout(function(){
                        $('#flash-container').css('display','none');
                    },  4000);
                    $('a[href="#activities"]').click();
                    window.location.hash = 'activities';
                    window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
                }
                else{
                }
            },
            error: function (response){
            }
        });
        function addbank(){
            var html = `
                            <div class="row bankRow">
                                <div class="col-lg-12 col-sm-11 col-md-11 col-12">
                                    <div class="card mt-2">
                                        <div class="card-header p-1">
                                            <h5 class="pl-2 orderbank" "><span onclick="removebank(this) class="float-right"><img src="{{ asset('images/bin.svg') }}"></span></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Name</label>
                                                            <input type="text" name="bank_names[]" class="form-control" placeholder="Add your company bank"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Abbreviation</label><span class="float-right"><small>(Optional)</small></span>
                                                            <input type="text" name="bank_abbreviation[]" class="form-control" placeholder="e.g CIB"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>SWIFT Code</label><span class="float-right"><small>(Optional)</small></span>
                                                            <input type="text" name="bank_swift_code[]" class="form-control" placeholder="Add your bank swift code"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>IBAN Code</label><span class="float-right"><small>(Optional)</small></span>
                                                            <input type="text" name="bank_iban_code[]" class="form-control" placeholder="Add bank iban code"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Country</label>
                                                            <select class="form-control " name="bank_country[]">
                                                                <option disabled selected value="">Choose Country</option>
                                                                @foreach (\App\Models\Country::all() as $country)
                                                                    <option value="{{ $country->id }}"> {{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-1 col-md-1"></div>
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Account Number</label>
                                                            <input type="number" name="bank_account_number[]" class="form-control" placeholder="Add your account number"
                                                                aria-describedby="helpId">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 col-md-5 col-sm-5 ">
                                                        <div class="form-group">
                                                            <label>Currency</label>
                                                            <select class="form-control" name="currency[]">
                                                                @include('supplier.registers.currency',['currencyValue'=>''])
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>`;
            $('#bankDiv').append(html);
            addordernumber(document.getElementsByClassName("orderbank"), 'Account', "removebank(this)");
        }
        $(document).on('click', '#editbank', function(event){
            $('#addbankrow').css('display', 'block');
        });
        function removebank(e){
            e.closest('div.bankRow').remove();
            addordernumber(document.getElementsByClassName("orderbank"), 'Account', "removebank(this)");

        }




    </script>
@endpush
