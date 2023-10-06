@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($banco->exists)
                <h4 class="titulo">Editar Banco</h4>
                <form action="{{ route('banco.update', ['banco' => $banco->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Banco</h4>
                    <form action="{{ route('banco.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('banco.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" class="form-control w-full" id="codigo"
                value="{{ $banco->exists ? $banco->codigo : old('codigo') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="banco" class="form-label">Banco</label>
            <input type="text" name="banco" class="form-control w-full" id="banco"
                value="{{ $banco->exists ? $banco->banco : old('banco') }}">
        </div>

        @php
            if (!$banco->exists) {
                $pago_movil = 0;
                $transferencia = 0;
            } else {
                $pago_movil = $banco->pago_movil;
                $transferencia = $banco->transferencia;
            }
        @endphp

        <div class="mt-4 mx-4">
            <label class="text-xs sm:text-sm text-center font-semibold">
                <input type="checkbox" name="pago_movil" class="form-control" value="pago_movil"
                    {{ $pago_movil ? 'checked' : '' }} />
                Recibe Pago Móvil
            </label>
        </div>

        <div class="mt-4 mx-4">
            <label class="text-xs sm:text-sm text-center font-semibold">

                <input type="checkbox" name="transferencia" class="form-control" value="transferencia"
                    {{ $transferencia ? 'checked' : '' }} />
                Recibe Transferencias
            </label>
        </div>

        <div class="mt-6 ml-4">
            @if ($banco->exists)
                @can('banco.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('banco.create')
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
