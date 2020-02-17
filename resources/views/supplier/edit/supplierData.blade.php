@extends('supplier.partials.app')
@push('css')
    <style>
        .reject{
            border: 1px solid #DC1B1B;	border-radius: 5px;
        }
    </style>
@endpush
@section('content')
    <div class="details mt-5">
        <div class="container">
            <div class="tabButton" >
                <ul class="nav nav-pills text-white bg-dark flex-column flex-md-row nav-justified">
                    <li class="nav-item border-right"><a class="nav-link active" data-toggle="pill"
                            href="#companyDetails">{{ $user->business_type=='distributor' ? 'Distributor':'Company' }} Details</a></li>
                    <li class="nav-item border-right"><a class="nav-link" data-toggle="pill" href="#branches"> 
                            Branches</a></li>
                    <li class="nav-item border-right"><a class="nav-link" data-toggle="pill" href="#bankAcc">Bank
                            Account</a></li>
                    <li class="nav-item border-right"><a class="nav-link" data-toggle="pill"
                            href="#activities">Activities</a></li>
                    <li class="nav-item border-right"><a class="nav-link" data-toggle="pill"
                            href="#uploadDocuments">Upload
                            Documents</a></li>
                    <li class="nav-item"><a class="nav-link" id="submitCheckTab" data-toggle="pill" href="#submitData">Submit Your Data </a>
                    </li>
                </ul>
            </div>
            <div id='flash-container' style="display: none;" class='flash-container mt-4 pt-2 pb-1'>
                <h3 class="text-center text-dark texNotif">Saved Successfully</h2>
            </div>
            <div class="tab-content">
                @include('supplier.edit.companyData')

                @include('supplier.edit.branches')
                
                @include('supplier.edit.banks')
                
                @include('supplier.edit.activity')

                @include('supplier.edit.document')

                @include('supplier.edit.submit')

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(".disableAll *").attr("disabled", "disabled").off('click');
        $(document).ready(function() {
            $('#country_id').trigger('change');
            $('.country_id').trigger('change');
            addordernumber(document.getElementsByClassName("orderagent"), "Agent");
            addordernumber(document.getElementsByClassName("contactOrder"), "Contact");
            addordernumber(document.getElementsByClassName("orderbank"), "Account");
            addordernumber(document.getElementsByClassName("orderbranch"), "Bransh");



        });
    </script>
@endpush
