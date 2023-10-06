@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Carga de Movimientos Bancarios</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('movimiento-banco.index') }}">Regresar</a>
        </div>

        <form action="{{ route('movimiento-banco.procesa-lote') }}" enctype="multipart/form-data" method="POST">
            @csrf


            <div class="mt-4 mx-4">
                <label for="archivo" class="form-label">Archivo XLSX</label>
                <input type="file" name="archivo" class="form-control btn btn-sm" id="archivo" accept=".xlsx">
            </div>

            <div class=" mt-6 ml-4">
                @can('banco.create')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Cargar</button>
                @endcan
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
