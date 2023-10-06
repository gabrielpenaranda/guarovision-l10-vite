@extends('layouts.front')


@section('content')
    <div class="container mx-auto max-w-3xl">
        <h3 class="flex justify-center text-gray-900 text-xs sm:text-base lg:text-xl font-semibold mt-8">
            Datos del Suscriptor
        </h3>
        <form action="{{ route('pago-web.cuenta', ['cliente' => $cliente->id]) }}" method="POST">
            @csrf
            <div class="mx-auto mt-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-left">
                        <label for="" class="form-label ml-4 sm:ml-14 mb-2">
                            Nombre(s) y Apellido(s)
                        </label>
                        <span class="text-xs sm:text-base md:text-lg sm:font-semibold hl-destroy ml-4 sm:ml-14">
                            {{ $cliente->nombres }} {{ $cliente->apellidos }}
                        </span>
                    </div>
                    <div class="text-center">
                        <label for="tipo" class="form-label mr-4 sm:mr-14 mb-2">
                            Cédula de Identidad
                        </label>
                        <span class="text-xs sm:text-base md:text-lg sm:font-semibold hl-destroy mr-4 sm:mr-14">
                            {{ $cliente->cedula }}
                        </span>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="tipo" class="form-label mx-4 sm:mx-14 mb-2">
                        Dirección
                    </label>
                    <span class="text-xs sm:text-base md:text-lg sm:font-semibold hl-destroy mx-4 sm:mx-14">
                        {{ $cliente->direccion }}, {{ $cliente->zona->ciudad->ciudad }},
                        {{ $cliente->zona->ciudad->estado->estado }}
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div class="text-left">
                    <label for="" class="form-label ml-4 sm:ml-14 mb-2">
                        Celular
                    </label>
                    <span class="text-xs sm:text-base md:text-lg sm:font-semibold hl-destroy ml-4 sm:ml-14">
                        {{ $cliente->telefono_celular }}
                    </span>
                </div>
                <div class="text-center">
                    <label for="tipo" class="form-label mr-4 sm:mr-14 mb-2">
                        Email
                    </label>
                    <span class="text-xs sm:text-base md:text-lg sm:font-semibold hl-destroy mr-4 sm:mr-14">
                        {{ $cliente->email }}
                    </span>
                </div>
            </div>
            <div class="text-center mt-10">
                <button type="submit" class="btn btn-sm btn-verde mx-2">Correcto?</button>
                {{-- <a href="{{ route('pago-web.index') }}">
                    <button class="btn btn-sm btn-red mx-2">
                        No
                    </button>
                </a> --}}
            </div>
        </form>
        <div class="text-right">
            <a href="{{ route('pago-web.index') }}"
                class="mr-8 sm:mr-20 text-xs sm:text-sm md:text-base underline text-red-600 font-semibold">
                Regresar
            </a>
        </div>
    </div>
@endsection
