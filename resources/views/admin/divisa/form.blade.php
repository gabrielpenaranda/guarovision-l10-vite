@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($divisa->exists)
                <h4 class="titulo">Editar Divisa</h4>
                <form action="{{ route('divisa.update', ['divisa' => $divisa->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Divisa</h4>
                    <form action="{{ route('divisa.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('divisa.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            @if ($divisa->exists)
                <label for="divisa" class="form-label mb-2">Divisa</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit">
                    {{ $divisa->divisa }}
                </span>
                <input type="hidden" name="divisa" value="{{ $divisa->divisa }}">
            @else
            <label for="divisa" class="form-label">Divisa</label>
            <input type="text" name="divisa" class="form-control w-full" id="divisa"
                value="{{ $divisa->exists ? $divisa->divisa : old('divisa') }}">
            @endif
        </div>

        <div class="mt-4 mx-4">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control w-full" id="descripcion"
                value="{{ $divisa->exists ? $divisa->descripcion : old('descripcion') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="simbolo" class="form-label">Simbolo:</label>
            <input type="text" name="simbolo" class="form-control w-full" id="simbolo"
                value="{{ $divisa->exists ? $divisa->simbolo : old('simbolo') }}">
        </div>


        <div class="mt-6 ml-4">
            @if ($divisa->exists)
                @can('divisa.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('divisa.create')
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
