@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Tasa de Cambio</h4>

            @can('divisa.index')
                <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('divisa.index') }}">Regresar</a>
            @endcan
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="divisa" class="form-label ml-8 sm:ml-14 mb-2">Divisa</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $divisa->divisa }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="descripcion" class="form-label ml-8 sm:ml-14 mb-2">Descripción</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $divisa->descripcion }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="simbolo" class="form-label ml-8 sm:ml-14 mb-2">Simbolo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $divisa->simbolo }}
                </span>
            </div>
        </div>

        <form action="{{ route('divisa.update_tasa', ['divisa' => $divisa->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mt-4 mx-4">
                <label for="tasa" class="form-label">Tasa de Cambio (1 {{ $divisa->divisa }} = ? BsD)</label>
                <input type="number" min="0" step="0.0001" name="tasa" class="form-control w-full" id="tasa"
                    value="{{ $divisa->exists ? $divisa->tasa : old('tasa') }}">
            </div>

            <div class="mt-6 ml-4">
                @can('divisa.tasa')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
