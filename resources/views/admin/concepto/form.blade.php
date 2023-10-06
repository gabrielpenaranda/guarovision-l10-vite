@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($concepto->exists)
                <h4 class="titulo">Editar Concepto</h4>
                <form action="{{ route('concepto.update', ['concepto' => $concepto->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Concepto</h4>
                    <form action="{{ route('concepto.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('concepto.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            @if ($concepto->exists)
                <label for="concepto" class="form-label mb-2">Concepto</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit">
                    {{ $concepto->concepto }}
                </span>
            @else
                <label for="concepto" class="form-label">Concepto</label>
                <input type="text" name="concepto" class="form-control w-full" id="concepto"
                    value="{{ $concepto->exists ? $concepto->concepto : old('concepto') }}">
            @endif
        </div>

        <div class="mt-4 mx-4">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="5" class="form-control w-full"
                value="{{ $concepto->exists ? $concepto->descripcion : old('descripcion') }}">{{ $concepto->exists ? $concepto->descripcion : old('descripcion') }}</textarea>
        </div>

        <div class="mt-4 mx-4">
            <label for="tarifa" class="form-label">Tarifa (sin impuestos)</label>
            <input type="number" min="0" step="0.01" name="tarifa" class="form-control w-full" id="tarifa"
                value="{{ $concepto->exists ? $concepto->tarifa : old('tarifa') }}">
        </div>

        {{-- <div class="mt-4 mx-4">
            <label for="cantidad" class="form-label">
                <input type="checkbox" name="cantidad" class="form-control" value="cantidad"
                    {{ $concepto->cantidad ? 'checked' : '' }} />
                Requiere Cantidad
            </label>
        </div> --}}

        <div class="mt-4 mx-4">
            <label for="divisa_id" class="form-label">Divisa</label>
            <select name="divisa_id" class="form-control w-full">
                @foreach ($divisas as $divisa)
                    @if ($concepto->exists)
                        @if ($concepto->divisa_id == $divisa->id)
                            <option value="{{ $divisa->id }}" selected>
                            @else
                            <option value="{{ $divisa->id }}">
                        @endif
                        {{ $divisa->divisa }}-{{ $divisa->descripcion }}
                    @else
                        <option value="{{ $divisa->id }}">
                            {{ $divisa->divisa }}-{{ $divisa->descripcion }}
                        </option>
                    @endif
                @endforeach
                </option>
            </select>
        </div>

        <div class="mt-6 ml-4">
            @if ($concepto->exists)
                @can('concepto.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('concepto.create')
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
