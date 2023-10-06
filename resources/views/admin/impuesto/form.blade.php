@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($impuesto->exists)
                <h4 class="titulo">Editar Impuesto</h4>
                <form action="{{ route('impuesto.update', ['impuesto' => $impuesto->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Impuesto</h4>
                    <form action="{{ route('impuesto.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('impuesto.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            @if ($impuesto->exists)
                <label for="impuesto" class="form-label mb-2">Impuesto</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit">
                    {{ $impuesto->impuesto }}
                </span>
            @else
                <label for="impuesto" class="form-label">Impuesto</label>
                <input type="text" name="impuesto" class="form-control w-full" id="impuesto"
                    value="{{ $impuesto->exists ? $impuesto->impuesto : old('impuesto') }}">
            @endif
        </div>

        <div class="mt-4 mx-4">
            <label for="tasa" class="form-label">Tasa</label>
            <input type="number" min="0" step="0.01" name="tasa" class="form-control w-full" id="impuesto"
                value="{{ $impuesto->exists ? $impuesto->tasa : old('tasa') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="es_activo" class="form-label">
                <input type="checkbox" name="es_activo" class="form-control" value="es_activo"
                    {{ $impuesto->es_activo ? 'checked' : '' }} />
                Activo
            </label> <br>
        </div>


        <div class="mt-6 ml-4">
            @if ($impuesto->exists)
                @can('impuesto.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('impuesto.create')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Crear</button>
                @endcan
            @endif
        </div>

        <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
