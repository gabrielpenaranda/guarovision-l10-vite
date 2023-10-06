@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    {{-- @php
    dd($pagos_taquilla);
    @endphp --}}
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Pago por Taquilla</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('pagos-taquilla.taquilla') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="modelo_pagos_taquilla_id" class="form-label ml-8 sm:ml-14 mb-2">Fecha</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo date_format($pagos_taquilla->created_at, 'd-m-Y');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="serial" class="form-label ml-8 sm:ml-14 mb-2">Número</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_taquilla->pago_taquilla }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="pon" class="form-label ml-8 sm:ml-14 mb-2">Cliente</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_taquilla->cliente->nombres }} {{ $pagos_taquilla->cliente->apellidos }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Taquilla</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_taquilla->taquilla->taquilla }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Monto Total Deuda US$</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pagos_taquilla->monto_total, 2, ',', '.');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Monto Efectivo Bs</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pagos_taquilla->monto_efectivo_bs, 2, ',', '.');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Monto
                    {{ $pagos_taquilla->divisa->simbolo }}</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo (string) number_format($pagos_taquilla->monto_efectivo_divisa, 2, ',', '.') . ' (Tasa: ' . (string) number_format($pagos_taquilla->tasa, 4, ',', '.') . ')';
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Monto POS Bs</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pagos_taquilla->monto_pos, 2, ',', '.');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">Banco POS</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14"">
                    {{ $pagos_taquilla->banco_pos->banco }}
                </span>
            </div>


        </div>



    </div>
@endsection

@section('scripts')
    @parent
@endsection
