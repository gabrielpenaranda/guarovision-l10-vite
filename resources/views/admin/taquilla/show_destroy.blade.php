@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-2xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Eliminar Taquilla</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('taquilla.index') }}">Regresar</a>
        </div>

        <div class="bg-white py-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Taquilla</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $taquilla->taquilla }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="tipo_taquilla" class="form-label ml-8 sm:ml-14 mb-2">Tipo de taquilla</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $taquilla->tipo_taquilla }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="direccion" class="form-label ml-8 sm:ml-14 mb-2">Dirección</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $taquilla->direccion }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Estado</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $taquilla->ciudad->ciudad }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Estado</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $taquilla->ciudad->estado->estado }}
                </span>
            </div>
        </div>



        <div class="mt-6 ml-4">
            <form action="{{ route('taquilla.destroy', ['taquilla' => $taquilla->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                @can('taquilla.destroy')
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
