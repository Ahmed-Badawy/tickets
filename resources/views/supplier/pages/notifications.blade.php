@extends('supplier.partials.app')

@section('content')
<div class="container"><br>
    <h3 class="text-left font-weight-bold" >Notifications</h2>
    <div class="contactUs bg-white py-4 px-3 mt-4">
        @foreach ($user->notifications->reverse() as $notify)
            <div class="row border-bottom pb-2 pt-3">
                <div class="col-lg-9">
                    <div class="media">
                        @switch($notify->status)
                            @case('approved')
                                <img src="{{ asset('images/check.svg') }}" class="mr-3">
                                @break
                            @case('rejected')
                                <img src="{{ asset('images/reje.svg') }}" class="mr-3">
                                @break
                            @case('date')
                                <img src="{{ asset('images/pend.svg') }}" class="mr-3">
                                @break
                            @default
                                <img src="{{ asset('images/check.svg') }}" class="mr-3">

                                @break
                        @endswitch
                        <div class="media-body mt-0">
                            <h6 class="texNotif mt-0">{!! $notify->content !!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <p class="text-right texNotif"><small>{{ $notify->created_at->format('d, M  H:i') }}</small></p>
                </div>
            </div>
        @endforeach
        
    </div>
</div><br><script>
    $(document).on('click', '.togglePasswordField', function(){
        let pass= $(this).parent().parent().prev();
        pass.attr('type', pass.attr('type') == 'text' ? 'password' : 'text');
        var type = pass.attr('type');
        type == 'password' ?
                            $(this).html('<i class="fa fa-eye-slash"></i>'):
                            $(this).html('<i class="fa fa-eye"></i>');
    })
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
@endsection

