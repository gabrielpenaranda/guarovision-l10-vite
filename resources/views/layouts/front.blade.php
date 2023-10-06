<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('partials._favicon')
    <title>{{ config('app.name', 'Laravel') }}</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

</head>

<body class="bg-gray-100">

    @include('partials._message')
    @include('partials._errors')

    <div class="relative flex items-top justify-center py-4 ">

        <div class="container">
            {{-- <img src="{{ asset('images/guarovision-logo-lg.png') }}" class="hidden lg:block mx-auto w-auto"
                alt="Guarovisión"> --}}
            <img src="{{ asset('images/guarovision-logo-md.png') }}" class="hidden sm:block mx-auto w-auto"
                alt="Guarovisión">
            <img src="{{ asset('images/guarovision-logo-sm.png') }}" class="block sm:hidden mx-auto w-auto"
                alt="Guarovisión">
        </div>

    </div>

    @yield('content')

    @stack('modals')

    @livewireScripts

</body>

</html>
