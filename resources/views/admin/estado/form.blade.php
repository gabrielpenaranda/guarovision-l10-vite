@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($estado->exists)
                <h4 class="titulo">Editar Estado</h4>
                <form action="{{ route('estado.update', ['estado' => $estado->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Estado</h4>
                    <form action="{{ route('estado.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('estado.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" name="estado" class="form-control w-full" id="estado"
                value="{{ $estado->exists ? $estado->estado : old('estado') }}">
        </div>


        <div class="mt-6 ml-4">
            @if ($estado->exists)
                @can('estado.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('estado.create')
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
