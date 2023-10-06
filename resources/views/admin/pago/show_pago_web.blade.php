@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Pago Web</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('pago.web') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Tipo de Pago</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    @if ($pago_web->tipo_pago == 'P')
                        Pago Móvil
                    @elseif ($pago_web->tipo_pago == 'T')
                        Transferencia
                    @endif
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Nº de Pago</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->pago_web }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Nº de Referencia</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->num_referencia }}
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
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Monto Bs.</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    @php
                        echo number_format($pago_web->monto, 2, ',', '.');
                    @endphp
                </span>
            </div>

            @if ($pago_web->imagen_pago)
                <div class="mt-4 mx-4">
                    <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Imágen Pago/label>
                        <img src="{{ $pago_web->imagen_pago }}" class="w-1/2">
                </div>
            @endif

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Cliente</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->cliente->nombres }} {{ $pago_web->cliente->apellidos }}
                </span>
            </div>


            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Realizado Por</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->realizado_por }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Número Telefónico</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->telefono_celular }}
                </span>
            </div>


            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Banco Origen</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->banco_origen->banco }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Banco Destino</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $pago_web->banco_destino->banco }}
                </span>
            </div>

        </div>



        <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
