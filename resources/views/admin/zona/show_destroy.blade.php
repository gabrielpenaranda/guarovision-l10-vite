@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Eliminar Zona</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('zona.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">ID</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $zona->id }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Zona</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $zona->zona }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Ciudad</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $zona->ciudad->ciudad }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Estado</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $zona->ciudad->estado->estado }}
                </span>
            </div>
        </div>



        <div class="mt-6 ml-4">
            <form action="{{ route('zona.destroy', ['zona' => $zona->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                @can('zona.destroy')
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
