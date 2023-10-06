@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Crear Consumo</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('recibo.recibo-cliente') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="grid grid-cols-3 gap-4 mt-4 ml-4">
                <div class="col-span-2">
                    <span class="form-label ml-8 sm:ml-14 mb-2">
                        Cliente
                    </span>
                    <span class="text-xs sm:text-base md:text-base text-left font-semibold hl-violeta">
                        {{ $cliente->nombres }} {{ $cliente->apellidos }}
                    </span>
                </div>
                <div>
                    <span class="form-label ml-8 sm:ml-14 mb-2">
                        C.I.
                    </span>
                    <span class="text-xs sm:text-base md:text-base font-semibold hl-violeta text-center">
                        {{ $cliente->cedula }}
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mt-4 ml-4">
                <div class="col-span-2">
                    <span class="form-label ml-8 sm:ml-14 mb-2">
                        Dirección
                    </span>
                    <span class="text-xs sm:text-base md:text-base text-left font-semibold hl-violeta">
                        {{ $cliente->direccion }}
                    </span>
                </div>
                <div>
                    <span class="form-label ml-8 sm:ml-14 mb-2">
                        Zona
                    </span>
                    <span class="text-xs sm:text-base md:text-base font-semibold hl-violeta text-center">
                        {{ $cliente->zona->zona }}
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <form action="{{ route('recibo.store-recibo', ['cliente' => $cliente->id]) }}" method="POST">
                @csrf

                <div class="mt-4 mx-4">
                    <label for="cedula" class="form-label mb-2">Concepto</label>
                    <select name="concepto" id="concepto" class="form-control">
                        @foreach ($conceptos as $concepto)
                            <option value="{{ $concepto->concepto }}">{{ $concepto->concepto }}
                                {{ $concepto->divisa->simbolo }} {{ $concepto->tarifa }}
                            </option>
                            @php
                                $concepto = $concepto->concepto;
                            @endphp
                        @endforeach

                    </select>
                </div>


                <div class="mt-6 ml-4">
                    @can('recibo.recibo')
                        <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Crear</button>
                    @endcan
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
