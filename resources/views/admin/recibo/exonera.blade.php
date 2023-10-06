@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-5xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Exonerar Consumos</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('recibo.recibo-cliente') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <div class="grid grid-cols-3 gap-2">
                    <div class="col-span-2">
                        <label for="" class="form-label ml-8 sm:ml-14 mb-2">Cliente</label>
                        <span class="text-xs sm:text-sm md:text-base font-semibold hl-carmesi ml-8 sm:ml-14">
                            {{ $cliente->apellidos }}, {{ $cliente->nombres }}
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label ml-8 sm:ml-14 mb-2">C.I.</label>
                        <span class="text-xs sm:text-sm md:text-base font-semibold hl-carmesi ml-8 sm:ml-14">
                            {{ $cliente->cedula }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('recibo.store-exonera', ['cliente' => $cliente->id]) }}" method="POST">
            @csrf
            <div class="bg-white pb-4 rounded-xl border-4">
                <div class=" grid grid-cols-6 mt-4 gap-2">
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
                <div class="mt-4 mx-4">
                    @foreach ($recibos as $recibo)
                        <div class="grid grid-cols-6 mt-4 gap-2">
                            <label class="text-xs sm:text-sm text-center">
                                <input type="checkbox" name="recibo_id[]" class="form-control"
                                    value="{{ $recibo->id }}" />
                                {{ $recibo->numero }}
                            </label>
                            <span class="text-xs sm:text-sm text-center">
                                @php
                                    echo date_format($recibo->created_at, 'd/m/Y');
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
                    @endforeach
                </div>
            </div>
            <div class="mt-6 ml-4">
                @if ($recibos->count())
                    @can('recibo.exonera')
                        <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Exonerar</button>
                    @endcan
                @endif
            </div>
        </form>


    </div>
@endsection

@section('scripts')
    @parent
@endsection
