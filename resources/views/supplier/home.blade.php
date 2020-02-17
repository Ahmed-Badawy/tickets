@extends('supplier.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            {{-- Activity --}}
            <aside class="col-sm-6">
                <p>Activity</p>
                <div class="card">
                    
                    <article class="card-body">
                            <div class="row">
                                <h4>Your Activities</h4>
                                @foreach ($user->activities as $activity)
                                    <div class="col-md-12">
                                        <p>{{ $activity->name }}</p>
                                    </div>
                                @endforeach
                                    <div class="col-md-6">
                                        @if(($user->status != 4  || $user->canEdit('Activity')) && $user->status != 0)
                                            <button type="button" class="btn btn-primary btn-block" id="editActivity"> Edit  </button>
                                        @elseif($user->status == 4)
                                            <button type="button" class="btn btn-primary btn-block changeRequest" data-form="Activity"> Change Request  </button>
                                        @endif
                                    </div>
                            </div>
                           
                        
                    </article>
                </div> <!-- card.// -->
            </aside> <!-- col.// -->
             {{-- Banks  --}}
            <aside class="col-sm-6">
                <p>Banks</p>
                <div class="card">
                    <article class="card-body">
                                <div class="row">
                                    <h4>Your Banks</h4>
                                    @foreach ($user->banks as $bank)
                                        <div class="col-md-12">
                                            <p>{{ $bank->bank_name }}</p>
                                        </div>
                                    @endforeach
                                        <div class="col-md-6">
                                            @if(($user->status != 4 || $user->canEdit('Bank')) && $user->status != 0)
                                                <button type="button" class="btn btn-primary btn-block" id="editbank"> Edit  </button>
                                            @elseif($user->status == 4)
                                                <button type="button" class="btn btn-primary btn-block changeRequest" data-form="Bank"> Change Request  </button>
                                            @endif
                                        </div>
                                </div>
                                
                            
                    </article>
                </div> <!-- card.// -->
            </aside> <!-- col.// -->
            {{-- Branches --}}
            <aside class="col-sm-6">
                <p>Branches</p>
                <div class="card">
                    <article class="card-body">
                                <div class="row">
                                    <h4>Your Branches</h4>
                                    @foreach ($user->branches as $branch)
                                        <div class="col-md-12">
                                            <p>{{ $branch->name }}</p>
                                        </div>
                                    @endforeach
                                        <div class="col-md-6">
                                            @if(($user->status != 4 || $user->canEdit('Branch')) && $user->status != 0)
                                                <button type="button" class="btn btn-primary btn-block" id="editbarnch"> Edit  </button>
                                            @elseif($user->status == 4)
                                                <button type="button" class="btn btn-primary btn-block changeRequest" data-form="Branch"> Change Request  </button>
                                            @endif
                                        </div>
                                </div>
                                
                        
                    </article>
                </div> <!-- card.// -->
            </aside> <!-- col.// -->
            {{-- Documents --}}
            <aside class="col-sm-6">
                    <p>Documents</p>
                    <div class="card">
                        <article class="card-body">
                            <div class="row">
                                <h4>Your Documents</h4>
                                @foreach ($user->documents as $document)
                                    <div class="col-md-12">
                                        <h5>{{ $document->document->name }}</h5>
                                        <a href="{{ asset('uploads/'.$document->file) }}">{{ $document->file }}</a>
                                        @if($document->start_date)
                                            <p>Start Date : {{ $document->start_date }}</p>
                                        @endif
                                        @if($document->expire_date)
                                            <p>Expire Date : {{ $document->expire_date }}</p>
                                        @endif

                                        <br><br><br>
                                    </div>
                                @endforeach
                                <div class="col-md-6">
                                    @if(($user->status != 4 || $user->canEdit('Document')) && $user->status != 0)
                                        <button type="button" class="btn btn-primary btn-block" id="editdocument"> Edit  </button>
                                    @elseif($user->status == 4)
                                        <button type="button" class="btn btn-primary btn-block changeRequest" data-form="Document"> Change Request  </button>
                                    @endif
                                </div>
                            </div>
                        </article>
                    </div> <!-- card.// -->
            </aside> 
            
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        
        
        $(document).on('click', '.changeRequest', function(){
            $.get('{{ URL::to("supplier/changeRequest") }}/'+ $(this).attr('data-form'),function(data){
                if(data.message == 'Done'){
                    alert('Your Request Has been sent Successfully');
                    location.reload();
                }

            });
        })
    </script>
@endpush