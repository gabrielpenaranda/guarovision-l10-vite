@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($equipo->exists)
                <h4 class="titulo">Editar Equipo</h4>
                <form action="{{ route('equipo.update', ['equipo' => $equipo->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Equipo</h4>
                    <form action="{{ route('equipo.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('equipo.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="modelo_equipo_id" class="form-label">Modelo de Equipo</label>
            <select name="modelo_equipo_id" class="form-control w-full">
                @foreach ($modelo_equipos as $modelo_equipo)
                    @if ($equipo->exists)
                        @if ($equipo->modelo_equipo_id == $modelo_equipo->id)
                            <option value="{{ $modelo_equipo->id }}" selected>
                            @else
                            <option value="{{ $modelo_equipo->id }}">
                        @endif
                        {{ $modelo_equipo->modelo_equipo }}
                    @else
                        <option value="{{ $modelo_equipo->id }}">
                            {{ $modelo_equipo->modelo_equipo }}
                        </option>
                    @endif
                @endforeach
                </option>
            </select>
        </div>

        <div class="mt-4 mx-4">
            <label for="serial" class="form-label">Serial</label>
            <input type="text" name="serial" class="form-control w-full" id="equipo"
                value="{{ $equipo->exists ? $equipo->serial : old('serial') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="pon" class="form-label">Identificador (PON)</label>
            <input type="text" name="pon" class="form-control w-full" id="equipo"
                value="{{ $equipo->exists ? $equipo->pon : old('pon') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" class="form-control w-full" id="equipo"
                value="{{ $equipo->exists ? $equipo->usuario : old('usuario') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="password" class="form-label">Password</label>
            <input type="text" name="password" class="form-control w-full" id="equipo"
                value="{{ $equipo->exists ? $equipo->password : old('password') }}">
        </div>


        <div class="mt-6 ml-4">
            @if ($equipo->exists)
                @can('equipo.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('equipo.create')
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
