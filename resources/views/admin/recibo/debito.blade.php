@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-4xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Nota de Débito</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('recibo.recibo-cliente') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        <label for="" class="form-label ml-8 sm:ml-14 mb-2">Cliente</label>
                        <span class="text-xs sm:text-sm md:text-base font-semibold hl-verde ml-8 sm:ml-14">
                            {{ $cliente->apellidos }}, {{ $cliente->nombres }}
                        </span>
                    </div>
                    <div>
                        <label for="" class="form-label ml-8 sm:ml-14 mb-2">C.I.</label>
                        <span class="text-xs sm:text-sm md:text-base font-semibold hl-verde ml-8 sm:ml-14">
                            {{ $cliente->cedula }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('recibo.store-debito', ['cliente' => $cliente->id]) }}" method="POST">
            @csrf
            <div class="bg-gray-100 pb-4 rounded-xl border-4">
                {{-- <div class="grid grid-cols-2 gap-4 mt4">
                    <div class="text-right">
                        <label for="credito" class="form-label">
                            <input type="radio" id="credito" name="nota" value="credito" class="form-control">

                            Crédito
                        </label>
                    </div>
                    <div class="text-left">
                        <label for="debito" class="form-label">
                            <input type="radio" id="debito" name="nota" value="debito" class="form-control">

                            Débito
                        </label>
                    </div>
                </div> --}}
                <div class="grid grid-cols-3 gap-4 mt-4 mx-8 sm:mx-14">
                    <div class="">
                        <label for="monto" class="form-label">Monto</label>
                        <input type="number" min="0.01" step="0.01" name="monto" id="monto"
                            value="{{ old('monto') }}" class="form-control" required>
                    </div>
                    <div class="col-span-2">
                        <label for="divisa_id" class="form-label">Divisa</label>
                        <select name="divisa_id" id="divisa_id" class="form-control w-full">
                            @foreach ($divisas as $divisa)
                                <option value="{{ $divisa->id }}">{{ $divisa->descripcion }} {{ $divisa->simbolo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-4 mx-8 sm:mx-14">
                    <label for="concepto" class="form-label">Concepto</label>
                    <input type="text" name="concepto" id="concepto" class="form-control w-full"
                        value="{{ old('concepto') }}" required>
                </div>
            </div>
            <div class="mt-6 ml-4">
                @can('recibo.create')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Crear</button>
                @endcan
            </div>
        </form>


    </div>
@endsection

@section('scripts')
    @parent
@endsection
