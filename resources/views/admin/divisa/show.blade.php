@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Divisa</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('divisa.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="divisa" class="form-label ml-8 sm:ml-14 mb-2">Divisa</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $divisa->divisa }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="descripcion" class="form-label ml-8 sm:ml-14 mb-2">Descripción</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $divisa->descripcion }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="simbolo" class="form-label ml-8 sm:ml-14 mb-2">Simbolo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $divisa->simbolo }}
                </span>
            </div>
        </div>



    </div>
@endsection

@section('scripts')
    @parent
@endsection
