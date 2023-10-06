@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Eliminar Marca de Equipo</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('marca-equipo.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="marca_equipo" class="form-label ml-8 sm:ml-14 mb-2">Tipo de Equipo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $marca_equipo->marca_equipo }}
                </span>
            </div>
        </div>



        <div class="mt-6 mx-4">
            <form action="{{ route('marca-equipo.destroy', ['marca_equipo' => $marca_equipo->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                @can('marca-equipo.destroy')
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
