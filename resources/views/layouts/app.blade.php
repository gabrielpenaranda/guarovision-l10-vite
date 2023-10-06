<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('partials._favicon')

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <!-- Styles -->
    @section('stylesheets')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('vendor/fa/css/all.min.css') }}">
    @show

    @livewireStyles

    <style>
        [x-cloak] {
            display: none !important;
        }

    </style>

    <!-- Scripts -->

</head>

<body class="font-sans antialiased bg-gray-100">

    @livewire('layouts.navigation')

    @include('partials._message')
    @include('partials._errors')

    {{-- <x-jet-banner /> --}}

    {{-- <div class="container mx-auto max-w-md mt-8">
        <img src="{{ asset('images/isotipo-fondo-blanco.png') }}"  alt="Guarovisión">
    </div> --}}

    {{-- <div class="max-h-screen bg-gray-100"> --}}

    <!-- Page Heading -->
    {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

    <!-- Page Content -->
    {{-- <main>
            {{ $slot }}
        </main> --}}
    {{-- </div> --}}

    @yield('content')

    @stack('modals')

    @section('scripts')
        <script>
            /* $('.confirmation').on('click', function() {
                                        return confirm('Esta seguro de ejecutar esta acción?');
                                    }); */

            function confirmation() {
                return confirm('Esta seguro de ejecutar esta acción?');
            }
        </script>
    @show

    @livewireScripts

</body>

</html>
