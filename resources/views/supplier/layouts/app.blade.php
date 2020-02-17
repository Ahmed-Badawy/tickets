<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('supplier.layouts.head')

    <body>
    <div id="app">
        @include('supplier.layouts.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@include('supplier.layouts.scripts')
@yield('scripts')
@stack('scripts')
</html>
