@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($modelo_equipo->exists)
                <h4 class="titulo">Editar Modelo de Equipo</h4>
                <form action="{{ route('modelo-equipo.update', ['modelo_equipo' => $modelo_equipo->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Modelo de Equipo</h4>
                    <form action="{{ route('modelo-equipo.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('modelo-equipo.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            {{-- @if ($modelo_equipo->exists)
                <label for="modelo_equipo" class="form-label ml-8 sm:ml-14 mb-2">Tipo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit ml-8 sm:ml-14">
                    {{ $modelo_equipo->tipo_equipo->tipo_equipo }}
                </span>
            @else --}}
                <label for="modelo_equipo" class="form-label">Modelo de Equipo</label>
                <input type="text" name="modelo_equipo" class="form-control w-full" id="modelo_equipo"
                    value="{{ $modelo_equipo->exists ? $modelo_equipo->modelo_equipo : old('modelo_equipo') }}">
            {{-- @endif --}}
        </div>

        <div class="mt-4 mx-4">
            <label for="tipo_equipo_id" class="form-label">Tipo:</label>
            <select name="tipo_equipo_id" class="form-control w-full">
                @foreach ($tipo_equipos as $tipo_equipo)
                    @if ($modelo_equipo->exists)
                        @if ($modelo_equipo->tipo_equipo_id == $tipo_equipo->id)
                            <option value="{{ $tipo_equipo->id }}" selected>
                            @else
                            <option value="{{ $tipo_equipo->id }}">
                        @endif
                        {{ $tipo_equipo->tipo_equipo }}
                    @else
                        <option value="{{ $tipo_equipo->id }}">
                            {{ $tipo_equipo->tipo_equipo }}
                        </option>
                    @endif
                @endforeach
                </option>
            </select>
        </div>

        <div class="mt-4 mx-4">
            <label for="marca_equipo_id" class="form-label">Marca:</label>
            <select name="marca_equipo_id" class="form-control w-full">
                @foreach ($marca_equipos as $marca_equipo)
                    @if ($modelo_equipo->exists)
                        @if ($modelo_equipo->marca_equipo_id == $marca_equipo->id)
                            <option value="{{ $marca_equipo->id }}" selected>
                            @else
                            <option value="{{ $marca_equipo->id }}">
                        @endif
                        {{ $marca_equipo->marca_equipo }}
                    @else
                        <option value="{{ $marca_equipo->id }}">
                            {{ $marca_equipo->marca_equipo }}
                        </option>
                    @endif
                @endforeach
                </option>
            </select>
        </div>


        <div class="mt-6 ml-4">
            @if ($modelo_equipo->exists)
                @can('modelo-equipo.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('modelo-equipo.create')
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
