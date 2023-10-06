@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($plan->exists)
                <h4 class="titulo">Editar Plan</h4>
                <form action="{{ route('plan.update', ['plan' => $plan->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Plan</h4>
                    <form action="{{ route('plan.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('plan.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            @if ($plan->exists)
                <label for="plan" class="form-label mb-2">Plan</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit">
                    {{ $plan->plan }}
                </span>
            @else
                <label for="plan" class="form-label">Plan</label>
                <input type="text" name="plan" class="form-control w-full" id="plan"
                    value="{{ $plan->exists ? $plan->plan : old('plan') }}">
            @endif
        </div>

        <div class="mt-4 mx-4">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="5" class="form-control w-full"
                value="{{ $plan->exists ? $plan->descripcion : old('descripcion') }}">{{ $plan->exists ? $plan->descripcion : old('descripcion') }}</textarea>
        </div>

        <div class="mt-4 mx-4">
            <label for="tarifa" class="form-label">Tarifa (sin impuestos)</label>
            <input type="number" min="0" step="0.01" name="tarifa" class="form-control w-full" id="tarifa"
                value="{{ $plan->exists ? $plan->tarifa : old('tarifa') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="divisa_id" class="form-label">Divisa</label>
            <select name="divisa_id" class="form-control w-full">
                @foreach ($divisas as $divisa)
                    @if ($plan->exists)
                        @if ($plan->divisa_id == $divisa->id)
                            <option value="{{ $divisa->id }}" selected>
                            @else
                            <option value="{{ $divisa->id }}">
                        @endif
                        {{ $divisa->divisa }}-{{ $divisa->descripcion }}
                    @else
                        <option value="{{ $divisa->id }}">
                            {{ $divisa->divisa }}-{{ $divisa->descripcion }}
                        </option>
                    @endif
                @endforeach
                </option>
            </select>
        </div>


        <div class="mt-6 ml-4">
            @if ($plan->exists)
                @can('plan.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('plan.create')
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
