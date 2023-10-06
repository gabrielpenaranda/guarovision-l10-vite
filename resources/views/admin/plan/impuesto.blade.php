@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Plan-Asignar Impuestos</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('plan.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <label for="plan" class="form-label ml-8 sm:ml-14 mb-2">ID</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $plan->id }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="plan" class="form-label ml-8 sm:ml-14 mb-2">Plan</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $plan->plan }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="descripcion" class="form-label ml-8 sm:ml-14 mb-2">Descrición</label>
                <p class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $plan->descripcion }}
                </p>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Tarífa</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $plan->divisa->simbolo }} {{ $plan->tarifa }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Impuestos Asignados</label>
                @if ($plan->impuestos->count() == 0)
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                        No tiene impuestos asignados
                    </span>
                @endif
                @foreach ($plan->impuestos as $impuesto)
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                        {{ $impuesto->impuesto }} ({{ $impuesto->tasa }}%)
                    </span> <br>
                @endforeach
            </div>
        </div>

        <form action="{{ route('plan.store_impuesto', ['plan' => $plan->id]) }}" method="POST">
            @csrf

            <div class="bg-white pb-4 rounded-xl border-4">
                <h4 class="titulo my-4 ml-8 sm:ml-14">Impuestos</h4>
                <span class="ml-8 sm:ml-14 mb-4 text-xs sm:text-sm">Seleccione TODOS los impuestos requeridos, incluidos
                    aquellos previamente asignados</span> <br>
                <select multiple name="impuesto[]" id="impuesto" class="form-control ml-8 sm:ml-14">
                    @foreach ($impuestos as $impuesto)
                        <option value="{{ $impuesto->id }}">{{ $impuesto->impuesto }} ({{ $impuesto->tasa }}%)
                        </option>
                    @endforeach
                </select>
                <br>
                <span class="ml-8 sm:ml-14 mb-4 text-xs sm:text-sm">Para seleccionar presione la tecla CTRL y haga click en
                    las opciones deseadas</span>

            </div>
            <div class="mt-6 mx-4">
                @can('plan.impuesto')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Asignar Impuestos</button>
                @endcan
            </div>
        </form>

    </div>
@endsection

@section('scripts')
    @parent
@endsection
