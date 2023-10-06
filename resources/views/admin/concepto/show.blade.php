@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Concepto</h4>

            @can('concepto.index')
                <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('concepto.index') }}">Regresar</a>
            @endcan
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <label for="concepto" class="form-label ml-8 sm:ml-14 mb-2">Concepto</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $concepto->concepto }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="descripcion" class="form-label ml-8 sm:ml-14 mb-2">Descrición</label>
                <p class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $concepto->descripcion }}
                </p>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Tarífa</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $concepto->divisa->simbolo }} {{ $concepto->tarifa }}
                </span>
            </div>

            {{-- <div class="mt-4 mx-4">
                <label for="es_activo" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-show">
                        @if ($concepto->cantidad)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Requiere Cantidad
                    </span>
                </label>
            </div> --}}
        </div>



        <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
