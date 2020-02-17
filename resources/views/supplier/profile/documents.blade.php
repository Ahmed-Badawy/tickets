<div id="uploadDocuments" class="tab-pane p-0 container">
        <form class="hideUploadDoc">
            <div class="uploadDocuments mt-5 mb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-lg-10">

                            @foreach ($documents as $key => $document)
                                <div class="accordion md-accordion mt-5 mb-5" id="accordionEx{{ $key }}" role="tablist" aria-multiselectable="true">

                                    <!-- Accordion card -->
                                    <div class="card firstUploadCollapse">

                                        <!-- Card header -->
                                        <div class="card-header p-3" role="tab">
                                            <a data-toggle="collapse" data-parent="#accordionEx{{ $key }}" href=".collapseOne{{ $key }}" aria-expanded="true"
                                                aria-controls="collapseOne{{ $key }}">
                                                <h5 class="m-0 border-bottom-0">
                                                    {{ $document->name }}
                                                    <i class="float-right fas fa-angle-down rotate-icon"></i>
                                                </h5>
                                            </a>
                                        </div>

                                        <!-- Card body -->
                                        <div  class="collapse show border-top-0 collapseOne{{ $key }}" role="tabpanel" aria-labelledby="headingOne1"
                                            data-parent="#accordionEx">
                                            <div class="card-body uploadShow">
                                                <p class="text-center p-2">
                                                    {{ $document->note }}
                                                </p>
                                                <div class="container">
                                                    @if($document->GetDate(false) || $document->GetDate(true))
                                                        <div class="row">
                                                            <div class="col-md-3"></div>
                                                            <div class="col-md-3">
                                                                <p><b><span class="pr-2" style="color:#4B4B4B"> Start Date </span></b><span> {{ $document->GetDate(true,'d/m/Y') }} </span></p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <p><b><span class="pr-2" style="color:#4B4B4B">Expire Date </span></b><span> {{ $document->GetDate(false,'d/m/Y') }} </span></p>
                                                            </div>
                                                            <div class="col-md-3"></div>
                                                        </div>
                                                    @endif
                                                    
                                                </div>
                                                @foreach ($document->uploaded() as $file)
                                                    <div class="bg-white pt-2 pl-2 pb-1 mt-2">
                                                        <p><img src="{{ asset('images/pdfUpload.png') }}" class="mr-2 pb-2"> {{ $file->pivot->file }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Accordion card -->
                                </div>
                            @endforeach
                            <!-- Accordion wrapper -->
                        </div>
                    </div>
                </div>
            </div>
            @if ($user->status == 3)
                <p class="text-right"><a href="{{ URL::to('supplier/editdata') }}" class="btn btnSubmit btnEditUpload">Edit Upload Documents</a></p>
            @endif
    </div>
