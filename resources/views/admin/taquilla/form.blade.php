@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($taquilla->exists)
                <h4 class="titulo">Editar Taquilla</h4>
                <form action="{{ route('taquilla.update', ['taquilla' => $taquilla->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Taquilla</h4>
                    <form action="{{ route('taquilla.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('taquilla.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="taquilla" class="form-label">Taquilla</label>
            <input type="text" name="taquilla" class="form-control w-full" id="taquilla"
                value="{{ $taquilla->exists ? $taquilla->taquilla : old('taquilla') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="tipo_taquilla" class="form-label">Tipo de taquilla:</label>
            <select name="tipo_taquilla" class="form-control w-full">
                <option value="Física">
                    Física
                </option>
                <option value="Web">
                    Web
                </option>
            </select>
        </div>

        <div class="mt-4 mx-4">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control w-full" id="direccion"
                value="{{ $taquilla->exists ? $taquilla->direccion : old('direccion') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="ciudad_id" class="form-label">Ciudad:</label>
            <select name="ciudad_id" class="form-control w-full">
                @foreach ($ciudades as $ciudad)
                    @if ($taquilla->exists)
                        @if ($taquilla->ciudad_id == $ciudad->id)
                            <option value="{{ $ciudad->id }}" selected>
                            @else
                            <option value="{{ $ciudad->id }}">
                        @endif
                        {{ $ciudad->ciudad }} - {{ $ciudad->estado->estado }}
                        </option>
                    @else
                        <option value="{{ $ciudad->id }}">
                            {{ $ciudad->ciudad }} - {{ $ciudad->estado->estado }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>


        <div class="mt-6 ml-4">
            @if ($taquilla->exists)
                @can('taquilla.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('taquilla.create')
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
