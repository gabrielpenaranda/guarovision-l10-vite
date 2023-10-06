@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Equipo</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('equipo.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="modelo_equipo_id" class="form-label ml-8 sm:ml-14 mb-2">Modelo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $equipo->modelo_equipo->modelo_equipo }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="serial" class="form-label ml-8 sm:ml-14 mb-2">Serial</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $equipo->serial }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="pon" class="form-label ml-8 sm:ml-14 mb-2">Identificador (PON)</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $equipo->pon }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Tipo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $equipo->modelo_equipo->tipo_equipo->tipo_equipo }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Tipo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $equipo->modelo_equipo->marca_equipo->marca_equipo }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="asignado" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-show">
                        @if ($equipo->asignado)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Asignado
                    </span>
                </label>
            </div>
        </div>



    </div>
@endsection

@section('scripts')
    @parent
@endsection
