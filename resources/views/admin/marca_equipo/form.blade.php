@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($marca_equipo->exists)
                <h4 class="titulo">Editar Marca de Equipo</h4>
                <form action="{{ route('marca-equipo.update', ['marca_equipo' => $marca_equipo->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Marca de Equipo</h4>
                    <form action="{{ route('marca-equipo.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('marca-equipo.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="marca_equipo" class="form-label">Marca de Equipo</label>
            <input type="text" name="marca_equipo" class="form-control w-full" id="marca_equipo"
                value="{{ $marca_equipo->exists ? $marca_equipo->marca_equipo : old('marca_equipo') }}">
        </div>


        <div class="mt-6 ml-4">
            @if ($marca_equipo->exists)
                @can('marca-equipo.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('marca-equipo.create')
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
