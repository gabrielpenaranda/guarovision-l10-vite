@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Consumo</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('recibo.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4">
                @if ($recibo->pagada)
                    <span class="text-base sm-text-lg font-bold text-verde-700 ml-8 sm:ml-14">
                        CANCELADO
                    </span>
                @else
                    <span class="text-base sm-text-lg font-bold text-red-700 ml-8 sm:ml-14">
                        NO CANCELADO
                    </span>
                @endif
                @if ($recibo->exento)
                    <span class="text-base sm-text-lg font-bold text-azul-700 ml-8 sm:ml-14">
                        EXONERADO
                    </span>
                @endif
            </div>
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="col-span-2">
                    <span class="form-label ml-8 sm:ml-14 mb-2">
                        Número
                    </span>
                    <span class="text-xs sm:text-base md:text-base font-semibold hl-show ml-8 sm:ml-14">
                        {{ $recibo->numero }}
                    </span>
                </div>
                <div>
                    <span class="form-label ml-8 sm:ml-14 mb-2">
                        Fecha
                    </span>
                    <span class="text-xs sm:text-base md:text-base font-semibold hl-show ml-8 sm:ml-14">
                        @php
                            echo date('d-m-Y', strtotime($recibo->fecha));
                        @endphp
                    </span>
                </div>
            </div>
            <div class="mt-4">
                <span class="form-label ml-8 sm:ml-14 mb-2">
                    Cliente
                </span>
                <p class="w-10/12 text-xs sm:text-base md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $recibo->cliente->nombres }} {{ $recibo->cliente->apellidos }}
                </p>
            </div>
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="col-span-2">
                    <span class="form-label ml-8 sm:ml-14 mb-2">
                        Concepto
                    </span>
                    <span class="text-xs sm:text-base md:text-base font-semibold hl-show ml-8 sm:ml-14">
                        {{ $recibo->concepto }}
                    </span>
                </div>
                <div>
                    <span class="form-label ml-8 sm:ml-14 mb-2">
                        Monto
                    </span>
                    <span class="text-xs sm:text-base md:text-base font-semibold hl-show ml-8 sm:ml-14">
                        @php
                            echo $recibo->divisa->simbolo . ' ' . number_format($recibo->monto_divisa, 2, ',', '.');
                        @endphp
                    </span>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @parent
@endsection
