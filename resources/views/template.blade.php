<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<style>
    .hover-text-primary:hover {
        color: #4e73df !important;
        transition: color 0.3s ease;
    }

    .border-primary {
        border-color: #4e73df !important;
    }
</style>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Clinica Dental Cristo Rey" />
    <meta name="author" content="" />
    <title>Clinica Dental Cristo Rey @yield('#')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" />
    <link href="{{ asset('favicon.ico') }}" rel="icon" type="image/ico" sizes="32x32">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('img/favicon.ico') }}" rel="icon" type="image/ico" sizes="32x32">

    @stack('css')

</head>
@auth

    <body class="sb-nav-fixed">

        <x-navigation-header />

        <div id="layoutSidenav">

            <x-navigation-menu />

            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <x-footer />
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="{{ asset('js/script.js') }}"></script>
        @stack('js')
    </body>
@endauth
@guest
    @include('pages.401')
@endguest

</html>
