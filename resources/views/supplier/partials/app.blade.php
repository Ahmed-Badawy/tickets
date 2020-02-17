<!DOCTYPE html>
<html lang="en">
    @include('supplier.partials.head')
    @stack('css')
    <body>
        @include('supplier.partials.header')
        @yield('content')

        @include('supplier.partials.footer')

        @include('supplier.partials.scripts')
         

        @stack('scripts')
    </body>
</html>
