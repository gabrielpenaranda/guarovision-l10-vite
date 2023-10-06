@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($ciudad->exists)
                <h4 class="titulo">Editar Ciudad</h4>
                <form action="{{ route('ciudad.update', ['ciudad' => $ciudad->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Ciudad</h4>
                    <form action="{{ route('ciudad.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('ciudad.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" name="ciudad" class="form-control w-full" id="ciudad"
                value="{{ $ciudad->exists ? $ciudad->ciudad : old('ciudad') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="estado_id" class="form-label">Estado:</label>
            <select name="estado_id" class="form-control w-full">
                @foreach ($estados as $estado)
                    @if ($ciudad->exists)
                        @if ($ciudad->estado_id == $estado->id)
                            <option value="{{ $estado->id }}" selected>
                            @else
                            <option value="{{ $estado->id }}">
                        @endif
                        {{ $estado->estado }}
                    @else
                        <option value="{{ $estado->id }}">
                            {{ $estado->estado }}
                        </option>
                    @endif
                @endforeach
                </option>
            </select>
        </div>


        <div class="mt-6 ml-4">
            @if ($ciudad->exists)
                @can('ciudad.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('ciudad.create')
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
