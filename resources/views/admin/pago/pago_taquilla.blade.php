@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-4 max-w-4xl">

        <div class="flex pb-2 items-center justify-between">
            <h4 class="titulo">Pagos por Taquila</h4>

        </div>
        <x-table>
            <form action="{{ route('pago.busca-pago-taquilla') }}" method="POST">
                @csrf
                <div class="px-6 py-4 align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">

                    <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                        <label for="inicio" class="form-label">Taquilla</label>
                        <select name="taquilla_id" id="" class="form-control">
                            @foreach ($taquillas as $taquilla)
                                <option value="{{ $taquilla->id }}">{{ $taquilla->taquilla }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                        <label for="inicio" class="form-label">Fecha desde</label>
                        <input type="date" name="inicio" class="form-control w-full" />
                    </div>

                    <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                        <label for="inicio" class="form-label">Fecha hasta</label>
                        <input type="date" name="final" class="form-control" />
                    </div>

                    <div class="flex-1 mt-2 sm:mt-6 sm:ml-4">
                        <button type="submit" class="btn btn-edit btn-xs sm:btn-sm mr-4">Buscar</button>
                    </div>
                </div>
            </form>

        </x-table>
    </div>
@endsection
