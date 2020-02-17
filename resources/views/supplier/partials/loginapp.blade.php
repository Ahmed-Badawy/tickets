<!DOCTYPE html>
<html lang="en">
    @include('supplier.partials.loginhead')
    @stack('css')
    <body>
        @include('supplier.partials.loginheader')
                @yield('content')
        @include('supplier.partials.loginfooter')

        @include('supplier.partials.scripts')
        @stack('scripts')
    </body>
</html>


