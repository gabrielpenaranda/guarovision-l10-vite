@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Eliminar Ciudad</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('ciudad.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Ciudad</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $ciudad->ciudad }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Estado</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-destroy ml-8 sm:ml-14">
                    {{ $ciudad->estado->estado }}
                </span>
            </div>
        </div>

        <div class="mt-6 ml-4">
            <form action="{{ route('ciudad.destroy', ['ciudad' => $ciudad->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                @can('ciudad.destroy')
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
