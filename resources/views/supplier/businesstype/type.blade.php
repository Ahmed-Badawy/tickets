@extends('supplier.partials.loginapp')

@section('content')
    <div class="choose">
        <div class="container"><br>
            <h3 class="text-center">Choose Your Business Type</h3><br><br>
            <form method="POST" action="{{ URL::to('supplier/type') }}" style="width: -webkit-fill-available;">
                {{ csrf_field() }}
                <div class="chooseOption p-4 pb-5 pt-5"><br>
                    <div class="row">
                        <div class="col-lg-5"><h5>What is the type of your business?</h5></div>
                        <div class="col-1"></div><br>
                        <div class="col-lg-2">
                            <label class="customRadio">Supplier
                                <input type="radio" value="supplier" name="type">
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                        <div class="col-lg-2">
                            <label class="customRadio">Vendor
                                <input type="radio" value="vendor" checked="checked" name="type">
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                        <div class="col-lg-2">
                            <label class="customRadio">Both
                                <input type="radio" value="both" name="type">
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-lg-5"><h5>Where's the site of your company?</h5></div>
                        <div class="col-1"></div><br>
                        <div class="col-lg-2">
                            <label class="customRadio">International
                                <input type="radio" value="1" checked name="national">
                                <span class="checkmarks"></span>
                            </label>
                            <small class="text-muted" style="font-size: 12px">(Headquarter Outside Egypt)</small>
                        </div>
                        <div class="col-lg-2">
                            <label class="customRadio">Domestic
                                <input type="radio" value="0"  name="national">
                                <span class="checkmarks"></span>
                            </label>
                            <small class="text-muted">(Headquarter Inside Egypt)</small>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-lg-5"><h5>What is the type of your business?</h5></div>
                        <div class="col-1"></div><br>
                        <div class="col-lg-2">
                            <label class="customRadio">Through our company
                                <input type="radio" value="company" name="business_type">
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                        <div class="col-lg-2">
                            <label class="customRadio">Through the Agent
                                <input type="radio" value="agent" checked="checked" name="business_type">
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                        <div class="col-lg-2">
                            <label class="customRadio">Both
                                <input type="radio" value="both" name="business_type">
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                    </div><br>
                </div><br>
                <p class="text-center pt-2"><button class="btn btnConfirm font-weight-bold"> Confirm </button></p>
            </form>
        </div>
    </div><br><br>

{{-- <div class="container">
    <div class="row justify-content-center">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row" style="width: -webkit-fill-available;">
            <aside class="col-sm-12">
                <h4>Choose Your Business Type</h4>
                <div class="card" style="width: -webkit-fill-available;">
                    <article class="card-body">
                        <div class="row">
                            <form method="POST" action="{{ URL::to('supplier/type') }}" style="width: -webkit-fill-available;">
                                {{ csrf_field() }}
                                <div class="row" >
                                    <div class="col-md-12">
                                       
                                        <div class="form-group">
                                            <label for="">Are You Supplier , Vendor Or Both</label>
                                            <div class="custom-radio">
                                                <input type="radio" value="vendor" id="vendor" name="type" checked>
                                                <label for="local">Vendor</label>
                                            </div>
                                            
                                            <!-- Default checked -->
                                            <div class="custom-radio">
                                                <input type="radio" value="supplier" id="supplier" name="type" >
                                                <label for="foreign">Supplier</label>
                                            </div>
                                            <div class="custom-radio">
                                                <input type="radio" value="both" id="both" name="type" >
                                                <label for="both">Both</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary btn-block"> Save  </button>
                                    </div>
                                </div> <!-- form-group// -->                                                           
                            </form>
                        </div>
                    </article>
                </div> <!-- card.// -->
            </aside> 
        </div>
    </div>
</div> --}}
@endsection