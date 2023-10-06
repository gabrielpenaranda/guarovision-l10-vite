@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-4xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Registrar Pago</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4"
                href="{{ route('pago.index', ['taquilla' => $taquilla->id]) }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="col-span-2">
                    <label for="" class="form-label ml-8 sm:ml-14 mb-2">Cliente</label>
                    <span class="text-xs sm:text-sm font-semibold hl-show ml-8 sm:ml-14">
                        {{ $cliente->nombres }} {{ $cliente->apellidos }}
                    </span>
                </div>
                <div class="">
                    <label for="" class="form-label ml-8 sm:ml-14 mb-2">C.I.</label>
                    <span class="text-xs sm:text-sm font-semibold hl-show ml-8 sm:ml-14">
                        {{ $cliente->cedula }}
                    </span>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div class="col-span-2">
                    <label for="" class="form-label ml-8 sm:ml-14 mb-2">Dirección</label>
                    <span class="text-xs sm:text-base font-semibold hl-show ml-8 sm:ml-14">
                        {{ $cliente->direccion }}
                    </span>
                </div>
                <div class="">
                    <label for="" class="form-label ml-8 sm:ml-14 mb-2">Zona</label>
                    <span class="text-xs sm:text-sm font-semibold hl-show ml-8 sm:ml-14">
                        {{ $cliente->zona->zona }}
                    </span>
                </div>
            </div>
        </div>

        <form action="{{ route('pago.store', ['cliente' => $cliente->id, 'taquilla' => $taquilla->id]) }}" method="POST">
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
                    @php
                        $acum = 0;
                    @endphp
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
                                    echo number_format($recibo->monto_bs_impuestos, 2, ',', '.');
                                @endphp
                            </span>
                            <span class="text-xs sm:text-sm text-right">
                                @php
                                    echo number_format($recibo->saldo, 2, ',', '.');
                                @endphp
                            </span>
                        </div>
                        @php
                            $acum += $recibo->saldo;
                        @endphp
                    @endforeach
                </div>
                <div class="mt-4 mx-4 text-right">
                    <h5 class="sub-titulo"> Monto a pagar US$
                        <span>
                            @php
                                echo number_format($acum, 2, ',', '.');
                            @endphp
                        </span>
                    </h5>
                    <h5 class="sub-titulo"> Tasa 1US$ -> Bs.
                        <span>
                            @php
                                echo number_format($divisas->tasa, 4, ',', '.');
                            @endphp
                        </span>
                    </h5>
                    <h5 class="sub-titulo"> Monto Bs.
                        <span>
                            @php
                                $monto_bs = $acum * $divisas->tasa;
                                echo number_format($monto_bs, 4, ',', '.');
                            @endphp
                        </span>
                    </h5>
                </div>
            </div>
            <div class="bg-white pb-4 rounded-xl border-4">
                <h5 class="titulo">Formas de Pago</h4>

                    <div class="grid grid-cols-2 gap-2 w-96 mx-auto mt-4">
                        <div class="align-middle">
                            <label for="monto_efectivo_bs" class="form-label text-right">Efectivo Bs.</label>
                        </div>
                        <div>
                            <input type="number" min="0" step="0.01" name="monto_efectivo_bs"
                                value="{{ old('monto_efectivo_bs') }}" class="form-control w-full" id="monto_efectivo_bs">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-96 mx-auto mt-4">
                        <div class="align-middle">
                            <label for="monto_efectivo_divisa" class="form-label text-right">Efectivo Divisa</label>
                        </div>
                        <div>
                            <input type="number" min="0" step="0.01" name="monto_efectivo_divisa"
                                value="{{ old('monto_efectivo_divisa') }}" class="form-control w-full"
                                id="monto_efectivo_divisa">
                        </div>
                        <input type="hidden" name="divisa_id" value="{{ $divisas->id }}">
                    </div>

                    {{-- <div class="grid grid-cols-2 gap-2 w-96 mx-auto mt-4">
                        <div class="align-middle">
                            <label for="divisa_id" class="form-label text-right">Divisa</label>
                        </div>
                        <div>
                            <select name="divisa_id" id="divisa_id" class="form-control w-full text-xs">
                                @foreach ($divisas as $divisa)
                                    @if ($divisa->divisa != 'VED')
                                        <option value="{{ $divisa->id }}">{{ $divisa->descripcion }}
                                            {{ $divisa->simbolo }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="grid grid-cols-2 gap-2 w-96 mx-auto mt-4">
                        <div class="align-middle">
                            <label for="monto_pos" class="form-label text-right">Punto de Venta</label>
                        </div>
                        <div>
                            <input type="number" min="0" step="0.01" name="monto_pos"
                                value="{{ old('monto_pos') }}" class="form-control w-full" id="monto_pos">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-96 mx-auto mt-4">
                        <div class="align-middle">
                            <label for="banco_id" class="form-label text-right">Banco</label>
                        </div>
                        <div>
                            <select name="banco_id" id="divisa_id" class="form-control w-full text-xs">
                                @foreach ($bancos as $banco)
                                    <option value="{{ $banco->id }}">{{ $banco->banco }}
                                        {{ $banco->simbolo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

            </div>

            <div class="mt-6 ml-4">
                @if ($recibos->count())
                    @can('pago.create')
                        <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Registrar
                            Pago</button>
                    @endcan
                @endif
            </div>
        </form>

    </div>
@endsection

@section('scripts')
    @parent
@endsection
