@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-4xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Cliente-Estado de Cuenta</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('recibo.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <label for="" class="form-label ml-8 sm:ml-14 mb-2">Cliente</label>
                        <span class="text-xs sm:text-sm md:text-base font-semibold hl-violeta ml-8 sm:ml-14">
                            {{ $cliente->apellidos }}, {{ $cliente->nombres }}
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label ml-8 sm:ml-14 mb-2">C.I.</label>
                        <span class="text-xs sm:text-sm md:text-base font-semibold hl-violeta ml-8 sm:ml-14">
                            {{ $cliente->cedula }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-100 pb-4 rounded-xl border-4">
            <div class=" grid grid-cols-6 mt-4 gap-4">
                <div class="text-xs sm:text-sm font-bold ml-4 text-center">
                    Número
                </div>
                <div class="text-xs sm:text-sm font-bold text-center">
                    Fecha
                </div>
                <div class="text-xs sm:text-sm font-bold col-span-2 text-center">
                    Concepto
                </div>
                <div class="text-xs sm:text-sm font-bold text-center">
                    Monto
                </div>
                <div class="text-xs sm:text-sm font-bold text-center">
                    Saldo
                </div>
            </div>
            @php
                $cont = count($array_pagos);
            @endphp
            <div class="mt-4 mx-4">
                @foreach ($recibos as $recibo)
                    <div class="grid grid-cols-6 mt-4 gap-4">
                        <span class="text-xs sm:text-sm text-center">
                            {{ $recibo->numero }}
                        </span>
                        <span class="text-xs sm:text-sm text-center">
                            @php
                                echo date('d/m/Y', strtotime($recibo->fecha));
                            @endphp
                        </span>
                        <span class="text-xs sm:text-sm text-left col-span-2">
                            {{ $recibo->concepto }}
                        </span>
                        <span class="text-xs sm:text-sm text-right">
                            @php
                                echo $recibo->divisa->simbolo . ' ' . number_format($recibo->monto_divisa, 2, ',', '.');
                            @endphp
                        </span>
                        <span class="text-xs sm:text-sm text-right">
                            @php
                                echo $recibo->divisa->simbolo . ' ' . number_format($recibo->saldo, 2, ',', '.');
                            @endphp
                        </span>
                    </div>
                    @for ($i = 0; $i < $cont; $i++)
                        @if ($array_pagos[$i]['recibo_id'] == $recibo->id)
                            <div class="grid grid-cols-6 mt-2 gap-4">
                                {{-- <div></div> --}}
                                <div class="text-xs sm:text-sm text-center font-semibold">Recibo</div>
                                <div class="text-xs sm:text-sm text-center">{{ $array_pagos[$i]['num_referencia'] }}</div>
                                <div class="text-xs sm:text-sm text-center">
                                    {{ $array_pagos[$i]['fecha'] }}
                                </div>
                                <div class="text-xs sm:text-sm text-center">
                                    {{ $array_pagos[$i]['concepto'] }}
                                </div>
                                <div class="text-xs sm:text-sm text-right">
                                    @php
                                        echo $recibo->divisa->simbolo . ' ' . number_format($array_pagos[$i]['monto_total'], 2, ',', '.');
                                    @endphp
                                </div>
                            </div>
                        @endif
                    @endfor
                    {{-- @foreach ($array_pagos as $pago)
                        @if ($pago)

                        @else

                        @endif
                    @endforeach --}}
                @endforeach
            </div>
        </div>


    </div>
@endsection

@section('scripts')
    @parent
@endsection
