@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Impuesto</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('impuesto.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="impuesto" class="form-label ml-8 sm:ml-14 mb-2">Impuesto</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $impuesto->impuesto }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="tasa" class="form-label ml-8 sm:ml-14 mb-2">Tasa</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $impuesto->tasa }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="es_activo" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-show">
                        @if ($impuesto->es_activo)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Activo
                    </span>
                </label>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @parent
@endsection
