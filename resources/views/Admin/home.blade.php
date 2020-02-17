@if(!Request::ajax())

    @extends('Admin.layouts.admin-layout')
    @push('styles')
        @include('Admin.common.styles')
        <style media="screen">

            .sidebar {
              list-style-type: none;
              margin-top: 10px;
              padding: 0 !important;
            }

            .sidebar li {
              cursor: pointer;
              list-style: none;
              margin-top: 20px;
              font: 200 20px/1.5 Georgia, serif;
              border-bottom: 1px solid #ccc;
            }

            .sidebar li:last-child {
              border: none;
            }

            .sidebar li a {
              text-decoration: none;
              color: #000;
              display: block;
              width: 200px;

              -webkit-transition: font-size 0.3s ease, background-color 0.3s ease;
              -moz-transition: font-size 0.3s ease, background-color 0.3s ease;
              -o-transition: font-size 0.3s ease, background-color 0.3s ease;
              -ms-transition: font-size 0.3s ease, background-color 0.3s ease;
              transition: font-size 0.3s ease, background-color 0.3s ease;
            }

            .sidebar li a:hover {
              font-size: 22px;
              background: #f6f6f6;
            }


        </style>
    @endpush

    @section('title','Sumed Home')

    @section('header')
        @include('Admin.common.header')
    @endsection

@endif

@section('content')
    <main id="main-content" class="col-md-10 float-left" style="height: 1200px;border: 1px solid #eaeaea;">
        @if(!Request::ajax())
          @switch(Request::route()->getName())

            @case('admin.admins')
              @include('Admin.contents.admins')
            @break
            @case('admin.activities')
              @include('Admin.contents.activities')
            @break
            @case('admin.members')
              @include('Admin.contents.members')
            @break
            @case('admin.suppliers')
              @include('Admin.contents.suppliers')
            @break

          @endswitch
        @endif
    </main>
@endsection

@if(!Request::ajax())

    @section('sidebar')
        @include('Admin.common.sidebar')
    @endsection

    @section('footer')
        @include('Admin.common.footer')
    @endsection

    @push('scripts')
        <script type="text/javascript">
            var token = "{{Session::token()}}";
            function fetchData(route){
                  var content = $('#main-content');
                  $.ajax({
                      url: route,
                      method:'GET',
                      data: {_token: token}
                  }).done((data) => {
                      //var url = $(this).attr('href');
                      window.history.pushState("", "", route);
                      content.html(data);
                  }).fail((error) => {

                  });
                // var display = document.getElementById("content");
                // var xmlhttp = new XMLHttpRequest();
                // xmlhttp.open("GET", "hello.php");
                // xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                // xmlhttp.send();
                // xmlhttp.onreadystatechange = function() {
                //   if (this.readyState === 4 && this.status === 200) {
                //     display.innerHTML = this.responseText;
                //   } else {
                //     display.innerHTML = "Loading...";
                //   };
                // }
            }
        </script>
    @endpush

@endif
