@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Eliminar Banco</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('banco.index') }}">Regresar</a>
        </div>


        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="banco" class="form-label ml-8 sm:ml-14 mb-2">Código</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $banco->codigo }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="banco" class="form-label ml-8 sm:ml-14 mb-2">Banco</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $banco->banco }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="es_activo" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy">
                        @if ($banco->pago_movil)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Acepta Pago Móvil
                    </span>
                </label>
            </div>

            <div class="mt-4 mx-4">
                <label for="es_activo" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy">
                        @if ($banco->transferencia)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Acepta Transferencia
                    </span>
                </label>
            </div>

        </div>




        <div class="mt-6 mx-4">
            <form action="{{ route('banco.destroy', ['banco' => $banco->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                @can('banco.destroy')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Eliminar</button>
                @endcan
            </form>
        </div>

        <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
