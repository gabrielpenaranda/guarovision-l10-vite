@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Generar Consumos</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('dashboard') }}">Regresar</a>
        </div>

        <form action="{{ route('recibo.genera') }}" method="POST">
            @csrf

            <div class="mt4 mx-4">
                <label for="dias_vencimiento" class=form-label>Días para el vencimiento
                    <input type="number" min=1 step=1 max=29 name="dias_vencimiento" class="form-control">
                </label>
            </div>

            <div class="mt-6">
                @can('recibo.genera')
                    @if (empty($consumido))
                        <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Generar Consumos Mes Actual</button>
                    @elseif ($fecha->month == $consumido->month && $fecha->year == $consumido->year)
                        <h4 class="titulo">El consumo del mes actual ya ha sido generado</h4>
                    @else
                        <h4 class="titulo">No es posible generar el consumo, comuniquese con el administrador del sistema</h4>
                    @endif
                @endcan
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
