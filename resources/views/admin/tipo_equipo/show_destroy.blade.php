@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Eliminar Tipo de Equipo</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('tipo-equipo.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="tipo_equipo" class="form-label ml-8 sm:ml-14 mb-2">Tipo de Equipo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $tipo_equipo->tipo_equipo }}
                </span>
            </div>
        </div>



        <div class="mt-6 mx-4">
            <form action="{{ route('tipo-equipo.destroy', ['tipo_equipo' => $tipo_equipo->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                @can('tipo-equipo.destroy')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Eliminar</button>
                @endcan
            </form>
        </div>

        <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
