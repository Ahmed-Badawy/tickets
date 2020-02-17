<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title','Sumed')</title>
    @stack('styles')
  </head>

  <body>
    <div class="container-fluid">
      @yield('header')

      @yield('sidebar')

      @yield('content')

      @yield('footer')
    </div>

    @include('Admin.common.scripts')
    @stack('scripts')
  </body>


</html>
