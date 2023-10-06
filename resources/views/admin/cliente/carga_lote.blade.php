@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Carga de Clientes</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('cliente.index') }}">Regresar</a>
        </div>

        <form action="{{ route('cliente.procesa-lote') }}" enctype="multipart/form-data" method="POST">
            @csrf


            <div class="mt-4 mx-4">
                <label for="archivo" class="form-label">Archivo CSV</label>
                <input type="file" name="archivo" class="form-control btn btn-sm" id="archivo" accept=".csv">
            </div>

            <div class=" mt-6 ml-4">
                @can('cliente.lote')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Cargar</button>
                @endcan
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
