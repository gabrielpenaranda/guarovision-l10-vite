@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($zona->exists)
                <h4 class="titulo">Editar Zona</h4>
                <form action="{{ route('zona.update', ['zona' => $zona->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Zona</h4>
                    <form action="{{ route('zona.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('zona.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="zona" class="form-label">Zona</label>
            <input type="text" name="zona" class="form-control w-full" id="zona"
                value="{{ $zona->exists ? $zona->zona : old('zona') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="ciudad_id" class="form-label">Ciudad:</label>
            <select name="ciudad_id" class="form-control w-full">
                @foreach ($ciudades as $ciudad)
                    @if ($zona->exists)
                        @if ($zona->ciudad_id == $ciudad->id)
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
            @if ($zona->exists)
                @can('zona.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('zona.create')
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
