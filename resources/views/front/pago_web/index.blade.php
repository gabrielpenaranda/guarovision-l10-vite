@extends('layouts.front')


@section('content')
    <div class="container mx-auto w-full">
        <h1 class="flex justify-center text-gray-900 text-xs sm:text-lg lg:text-2xl font-bold mt-2">Bienvenido al Portal
            de
            Pagos
        </h1>
        <h3 class="flex justify-center text-gray-900 text-xs sm:text-base lg:text-xl font-semibold mt-8">Introduzca la
            cédula
            de
            identidad del suscriptor
        </h3>
        <form action="{{ route('pago-web.carga_datos') }}" method="POST">
            @csrf
            <div class="mx-auto mt-4">
                <div class="grid grid-cols-2 gap-4 mt4">
                    <div class="text-right">
                        <label for="tipo" class="form-label">
                            <input type="radio" id="venezolano" name="tipo" value="V" class="form-control"
                                checked>

                            V
                        </label>
                    </div>
                    <div class="text-left">
                        <label for="tipo" class="form-label">
                            <input type="radio" id="extranjero" name="tipo" value="E" class="form-control">

                            E
                        </label>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <input type="text" name="cedula" id="cedula" value="{{ old('cedula') }}"
                    class="form-control w-1/3 text-center" placeholder="Ej. 98765432 (sólo numeros)">
            </div>
            <div class="text-center mt-6">
                <button type="submit" class="btn btn-sm btn-verde">Enviar</button>
            </div>
        </form>
        <div class="grid grid-cols-2 gap-4">
            <div class="mt-4 mx-4">
                <h3 class="flex justify-center text-gray-900 text-xs sm:text-base lg:text-xl font-semibold mt-8">
                    Pago Móvil
                </h3>
                @foreach ($bancos as $banco)
                    @if ($banco->pago_movil)
                        <p class="ml-4 sm:ml-8 md:ml-16">
                            <span class="text-xs sm:text-sm md:text-base font-semibold">{{ $banco->banco }}</span><br>
                            <span class="text-xs sm:text-sm md:text-base">A nombre de:
                                {{ $banco->pago_movil_nombre }}</span><br>
                            <span class="text-xs sm:text-sm md:text-base">Teléfono:
                                {{ $banco->pago_movil_telefono }}</span><br>
                            <span class="text-xs sm:text-sm md:text-base">Cédula / RIF:
                                {{ $banco->pago_movil_rif }}</span>
                        </p>
                        <br>
                    @endif
                @endforeach
            </div>
            <div class="mt-4 mx-4">
                <h3 class="flex justify-center text-gray-900 text-xs sm:text-base lg:text-xl font-semibold mt-8">
                    Transferencias
                </h3>
                @foreach ($bancos as $banco)
                    @if ($banco->transferencia)
                        <p class="ml-4 sm:ml-8 md:ml-16">
                            <span class="text-xs sm:text-sm md:text-base font-semibold">{{ $banco->banco }}</span><br>
                            <span class="text-xs sm:text-sm md:text-base">Cuenta Nº:
                                {{ $banco->transferencia_cuenta }}</span><br>
                            <span class="text-xs sm:text-sm md:text-base">Titular:
                                {{ $banco->transferencia_nombre }}</span><br>
                            <span class="text-xs sm:text-sm md:text-base">Cédula /
                                RIF: {{ $banco->transferencia_rif }}</span>
                        </p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
