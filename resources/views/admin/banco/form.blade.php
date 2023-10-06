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
            <label for="pago_movil_nombre" class="form-label">A nombre de</label>
            <input type="text" name="pago_movil_nombre" class="form-control w-full" id="pago_movil_nombre"
                value="{{ $banco->exists ? $banco->pago_movil_nombre : old('pago_movil_nombre') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="pago_movil_telefono" class="form-label">Nº Telefónico</label>
            <input type="text" name="pago_movil_telefono" class="form-control w-full" id="pago_movil_telefono"
                value="{{ $banco->exists ? $banco->pago_movil_telefono : old('pago_movil_telefono') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="pago_movil_rif" class="form-label">Cédula/RIF</label>
            <input type="text" name="pago_movil_rif" class="form-control w-full" id="pago_movil_rif"
                value="{{ $banco->exists ? $banco->pago_movil_rif : old('pago_movil_rif') }}">
        </div>

        <div class="mt-4 mx-4">
            <label class="text-xs sm:text-sm text-center font-semibold">

                <input type="checkbox" name="transferencia" class="form-control" value="transferencia"
                    {{ $transferencia ? 'checked' : '' }} />
                Recibe Transferencias
            </label>
        </div>

        <div class="mt-4 mx-4">
            <label for="transferencia_cuenta" class="form-label">Cuenta Nº</label>
            <input type="text" name="transferencia_cuenta" class="form-control w-full" id="transferencia_cuenta"
                value="{{ $banco->exists ? $banco->transferencia_cuenta : old('transferencia_cuenta') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="transferencia_nombre" class="form-label">Titular</label>
            <input type="text" name="transferencia_nombre" class="form-control w-full" id="transferencia_nombre"
                value="{{ $banco->exists ? $banco->transferencia_nombre : old('transferencia_nombre') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="transferencia_rif" class="form-label">Cédula/RIF</label>
            <input type="text" name="transferencia_rif" class="form-control w-full" id="transferencia_rif"
                value="{{ $banco->exists ? $banco->transferencia_rif : old('transferencia_rif') }}">
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
