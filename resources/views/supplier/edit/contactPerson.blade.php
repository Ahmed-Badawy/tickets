@extends('supplier.layouts.app')

@section('content')
<div class="container">
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
                <p>Contact Person</p>
                <div class="card" style="width: -webkit-fill-available;">
                    <article class="card-body">
                        <div class="row">
                            <h4 class="card-title mb-4 mt-1">Contact Person</h4>
                            <form method="POST" action="{{ URL::to('supplier/contactPerson') }}" style="width: -webkit-fill-available;">
                                {{ csrf_field() }}
                                <div class="row" id="branchDiv">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" class="form-control" placeholder="Name" type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" class="form-control" placeholder="Email" type="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input name="phone" class="form-control" placeholder="Phone" type="text" required>
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
</div>
@endsection

@push('scripts')
@endpush