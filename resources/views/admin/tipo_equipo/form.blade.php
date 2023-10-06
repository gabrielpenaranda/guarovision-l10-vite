@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($tipo_equipo->exists)
                <h4 class="titulo">Editar Tipo de Equipo</h4>
                <form action="{{ route('tipo-equipo.update', ['tipo_equipo' => $tipo_equipo->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Tipo de Equipo</h4>
                    <form action="{{ route('tipo-equipo.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('tipo-equipo.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="tipo_equipo" class="form-label">Tipo de Equipo</label>
            <input type="text" name="tipo_equipo" class="form-control w-full" id="tipo_equipo"
                value="{{ $tipo_equipo->exists ? $tipo_equipo->tipo_equipo : old('tipo_equipo') }}">
        </div>


        <div class="mt-6 ml-4">
            @if ($tipo_equipo->exists)
                @can('tipo-equipo.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('tipo-equipo.create')
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
