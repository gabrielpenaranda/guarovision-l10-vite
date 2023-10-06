@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Plan</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('plan.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <label for="plan" class="form-label ml-8 sm:ml-14 mb-2">ID</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $plan->id }}
                </span>
            </div>

           <div class="mt-4 mx-4">
                <label for="plan" class="form-label ml-8 sm:ml-14 mb-2">Plan</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $plan->plan }}
                </span>
            </div>

            <div class="mt-4 mx-4">
                <label for="descripcion" class="form-label ml-8 sm:ml-14 mb-2">Descrición</label>
                <p class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $plan->descripcion }}
                </p>
            </div>

            <div class="mt-4 mx-4">
                <label for="estado" class="form-label ml-8 sm:ml-14 mb-2">Tarífa</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-show ml-8 sm:ml-14">
                    {{ $plan->divisa->simbolo }} {{ $plan->tarifa }}
                </span>
            </div>
        </div>



        <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
