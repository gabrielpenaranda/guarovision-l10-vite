@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Pago Taquilla</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('pago.taquilla') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Nº de Pago</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->pago_taquilla }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Fecha</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo date_form($pago_web->created_at, 'd-m-Y');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Cliente</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->cliente->nombres }} {{ $pago_web->cliente->apellidos }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Monto Total Bs.</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pago_web->monto_total, 2, ',', '.');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Monto Efectivo Bs.</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pago_web->monto_efectivo_bs, 2, ',', '.');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Monto Efectivo
                    {{ $pago_taquilla->divisa->simbolo }}</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pago_web->monto_efectivo_divisa, 2, ',', '.');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Monto POS
                    {{ $pago_taquilla->divisa->simbolo }}</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pago_web->monto_pos, 2, ',', '.');
                    @endphp
                </span>
            </div>

            @if ($pago_taquilla->banco_id)
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Banco POS</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_taquilla->banco->banco }}
                </span>
            @endif


        </div>



        <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
