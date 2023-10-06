@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Eliminar Pago Web</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('pagos-web.web') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="modelo_pagos_web_id" class="form-label ml-8 sm:ml-14 mb-2">Fecha</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo date_format($pagos_web->created_at, 'd-m-Y');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="serial" class="form-label ml-8 sm:ml-14 mb-2">Número</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_web->pago_web }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="pon" class="form-label ml-8 sm:ml-14 mb-2">Cliente</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_web->cliente->nombres }} {{ $pagos_web->cliente->apellidos }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Tipo de Pago</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    @if ($pagos_web->tipo_pago == 'M')
                        Pago Móvil
                    @elseif ($pagos_web->tipo_pago == 'T')
                        Transferencia
                    @endif
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Referencia</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_web->num_referencia }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">Realizado por</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_web->realizado_por }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">Cédula</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_web->cedula }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">Teléfono Celular</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_web->telefono_celular }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">Monto</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pagos_web->monto, 2, ',', '.');
                    @endphp
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">Banco Origen</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_web->banco_origen->banco }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">Banco Destino</label>
                <span class="text-xs sm:text-sm md:text-base font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pagos_web->banco_destino->banco }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-show">
                        @if ($pagos_web->conciliado)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Conciliado
                    </span>
                </label>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-show">
                        @if ($pagos_web->confirmado)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Confirmado
                    </span>
                </label>
            </div>

            @if ($pagos_web->imagen_pago)
                <div class="mt-4 mx-4">
                    {{-- <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2"></label> --}}
                    <img src="{{ asset('storage/imagenes_pagos_web/' . $pagos_web->imagen_pago) }}"
                        class="text-xs sm:text-sm md:text-base font-semibold hl-show" />
                    {{ $pagos_web->banco_destino->banco }}
                    <img src="" alt="">
                </div>
            @endif

        </div>

        <div class="mt-6 ml-4">
            <form action="{{ route('pagos-web.web-destroy', ['pagos_web' => $pagos_web->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                @can('pagos-web.web-show')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Eliminar</button>
                @endcan
            </form>
        </div>



    </div>
@endsection

@section('scripts')
    @parent
@endsection
