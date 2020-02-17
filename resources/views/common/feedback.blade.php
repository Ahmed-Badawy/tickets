@if (Session::has('success'))
    <div class="alert alert-success text-center">
        {{ (string)Session::get('success') }}
    </div>
@endif

@if (Session::has('fail'))
    <div class="alert alert-danger text-center">
        {{ (string)Session::get('fail') }}
    </div>
@endif

@if($errors)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger text-center">
            {{ $error }}
        </div>
    @endforeach
@endif
