
@push('css')
    <style>
        .upBorder{
            border-radius: 7px;
        }
    </style>
@endpush
<div id="uploadDocuments" class="tab-pane">
    <form enctype="multipart/form-data" id="documentForm" action="{{ URL::to('supplier/adddocument') }}" method="POST">
        @csrf
        <div class="uploadDocuments mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-lg-10">
                        <!--Accordion wrapper-->

                            @foreach ($documents as $key => $document)
                                    <div class="accordion md-accordion mt-5 mb-5" id="accordionEx" role="tablist" aria-multiselectable="true">

                                        <!-- Accordion card -->
                                        <div class="card  firstUploadCollapse">

                                            <!-- Card header -->
                                            <div id="doucumentnum_{{ $document->id }}" class="documentsclass card-header p-3" role="tab">
                                                <a data-toggle="collapse" data-parent="#accordionEx" href=".collapseOne_{{ $key }}" aria-expanded="true"
                                                    aria-controls="collapseOne_{{ $key }}">
                                                    <h5 class="m-0 border-bottom-0">
                                                        {{ $document->name }} {{ $document->required ? '':' (Optional)' }}
                                                        <span class="pl-3" data-toggle="tooltip" style="cursor:pointer" data-placement="top" title="please upload documents correctly">
                                                        <i class="far fa-question-circle"></i></span>
                                                        <span class="spanReq" style="color: red;font-size: 12px;display:none;" id="span_{{ $document->id }}"></span>
                                                        <span class="spanReq" style="color: red;font-size: 12px;display:none;" id="span_expire_{{ $document->id }}"></span>
                                                        <i class="float-right fas fa-angle-down rotate-icon"></i>
                                                    </h5>
                                                </a>
                                            </div>

                                            <!-- Card body -->
                                            <div  class="collapse borderd border-top-0 collapseOne_{{ $key }}" role="tabpanel" aria-labelledby="headingOne1"
                                                data-parent="#accordionEx">
                                                <div class="card-body">
                                                    <p class="text-center p-2">
                                                            {{ $document->note }}
                                                    </p>
                                                    <div class="container exDate">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-12" id="uploadedFileDiv_{{ $document->id }}">
                                                                <div class="form-inline justify-content-center text-center mb-2">
                                                                    <div class="form-group">
                                                                        <label class="font-weight-bold mr-2">Start Date</label>
                                                                        <input type="date" name="start_dates[{{ $document->id }}]" data-type="Start" data-id="{{ $document->id }}" {{ $document->start_required?'required':'' }} class="form-control {{ $document->start_required?'requiredFiled':'' }}" value="{{ $document->GetDate(true) }}" placeholder="" aria-describedby="helpId">

                                                                        <label class="font-weight-bold ml-4 mr-2">Expire date</label>
                                                                        <input type="date" name="expire_dates[{{ $document->id }}]" data-type="Expire" data-id="{{ $document->id }}" class="form-control {{ $document->expire_required?'requiredFiled':'' }}" {{ $document->expire_required?'required':'' }} vlaue="{{ $document->GetDate(false) }}" placeholder="" aria-describedby="helpId">
                                                                    </div>
                                                                    <div class="container text-center">
                                                                        <p class="mt-3">Drag & Drop or click in the box to upload Files</p>
                                                                        <input class="thefiles_{{ $document->id }}" type="file" name="files" accept=".pdf" multiple>
                                                                        <p class="mt-2">We support pdf only (up to 3 files). Make sure that your files are not more than 5 MB.</p>
                                                                    </div>
                                                                </div>
                                                                @foreach ($document->uploaded() as $file)
                                                                    <div class="bg-white pt-3 pl-2 pb-1 mt-4 upBorder" id="uploadfile_{{ $file->pivot->id }}">
                                                                        <p class="mb-2"><img src="{{ asset('images/pdfUpload.png') }}" height="38px" class="ml-2 pb-2"> {{ $file->pivot->file }}
                                                                        <span class="float-right pr-3"><label class="pt-1 pr-3">{{ $document->human_filesize($file->pivot->file) }} </label><img src="{{ asset('images/bin.svg') }}" onclick="deleteFileUploaded({{ $file->pivot->id }})"></span></p>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <!-- Accordion card -->

                                    </div>
                                    <script>
                                        $(function() {
                                            $('.thefiles_{{ $document->id }}').FancyFileUpload({
                                                url : 'documents',
                                                params :{
                                                    documentId: '{{ $document->id }}',
                                                    _token : document.head.querySelector('meta[name="csrf-token"]').content
                                                },
                                                edit : false,
                                                maxfilesize : 5240000,
                                                added : function(e, data) {
                                                    if(this.find(".ff_fileupload_errors").text()=="") this.find('.ff_fileupload_actions button.ff_fileupload_start_upload').click();
                                                },
                                                uploadcompleted : function(e, data) {
                                                    $('#uploadedFileDiv_{{ $document->id }}').append(
                                                                '<div class="bg-white pt-3 pl-2 pb-1 mt-4 upBorder" id="uploadfile_'+data.result.id+'">'+
                                                                    '<p class="mb-2"><img src="{{ asset("images/pdfUpload.png") }}" height="38px" class="ml-2 pb-2"> ' + data.result.name +
                                                                    '<span class="float-right pr-3"><label class="pt-1 pr-3">'+ data.result.size +' </label><img src="{{ asset("images/bin.svg") }}" onclick="deleteFileUploaded('+data.result.id +')"></span></p>'+
                                                                '</div>'
                                                    )
                                                    $('.ff_fileupload_uploads').html("");
                                                }
                                            });
                                        });
                                    </script>
                            @endforeach
                        <!-- Accordion wrapper -->
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" id="submitDocsBtn" class="btn btnSubmit float-right mb-2">Save and Continue <i class="fa fa-angle-right"></i></button><br>
    </form>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){

            try {
                $('#documentForm')
                    .ajaxForm({
                        url : $('#documentForm').attr('action'), // or whatever
                        type : $('#documentForm').attr('method'), // or whatever
                        dataType : 'json',
                        success : function (response) {
                            if(response.success){
                                $('a[href="#submitData"]').click();
                                window.location.hash = 'submitData';
                                window.scrollTo({ top: 0, left: 0, behavior: 'smooth' });
                            }
                            else{
                            }
                        },
                        error: function (response){
                        }
                    });
                    $(document).on('click', '#submitDocsBtn',function(){
                        $('.spanReq').css('display','none');
                        if($('.requiredFiled').length){
                            $('.requiredFiled').each(function(i) {
                                var item = $('.requiredFiled')[i];
                                var val = $(item).val();
                                if(!val){
                                    if($(item).attr('data-type') == 'Start'){
                                        var span=$('#span_'+$(item).attr('data-id'));
                                        span.text('Start Date Required');
                                        span.css('display','block');

                                    }
                                    else{
                                        var span=$('#span_expire_'+$(item).attr('data-id'))
                                        span.text('Expire Date Required');
                                        span.css('display','block');
                                    }
                                }
                            })
                        }
                    })
            }
            catch (e) {
                console.log('Fail');
            }
        })
            
    </script>
    <script>
        function deleteFileUploaded(fileId){
            var token = $("meta[name='csrf-token']").attr("content");

                $.ajax(
                    {
                        url: "{{ URL::to('supplier/documents') }}/"+fileId,
                        type: 'DELETE',
                        data: {
                            "id": fileId,
                            "_token": token,
                        },
                        success: function (response){
                            document.getElementById('uploadfile_'+fileId).remove();
                        }
                    });
        }
    </script>
@endpush
