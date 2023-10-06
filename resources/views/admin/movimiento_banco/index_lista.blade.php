@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-4 max-w-4xl">

        <div class="flex pb-2 items-center justify-between">
            <h4 class="titulo">Movimientos Bancarios</h4>
            <div class="flex-col sm:flex-row inline-flex">
                @can('banco.create')
                    <a href="{{ route('movimiento-banco.carga-lote') }}"
                        class="btn btn-verde btn-xs sm:btn-sm mr-4 text-center">Cargar
                        Lote</a>
                @endcan
                <a href="{{ route('movimiento-banco.index') }}"
                    class="btn btn-red btn-xs sm:btn-sm mr-4 sm:mr-0 mt-2 sm:mt-0">Regresar</a>
            </div>
        </div>
        <x-table>

            @if ($movimiento_bancos->count())
                <table class="min-w-full
                    divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                fecha

                            </th>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                referencia

                            </th>
                            <th scope="col"
                                class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                cédula

                            </th>
                            <th scope="col"
                                class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                teléfono

                            </th>
                            <th scope="col"
                                class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                monto Bs

                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($movimiento_bancos as $banco)
                            <tr>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                        @php
                                            // dd($banco->fecha);
                                            echo date('d-m-Y', strtotime($banco->fecha));
                                        @endphp
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                        {{ $banco->referencia }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 hidden sm:table-cell">
                                    <span
                                        class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                        {{ $banco->cedula }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 hidden sm:table-cell">
                                    <span
                                        class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                        {{ $banco->telefono }}
                                    </span>
                                </td>


                                <td class="px-6 py-4 hidden sm:table-cell text-right">
                                    <span
                                        class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted ">
                                        @php
                                            echo number_format($banco->monto, 2, ',', '.');
                                        @endphp
                                    </span>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <div class="px-6 py-3">
                    {!! $movimiento_bancos->render() !!}
                </div>
            @else
                <div class="px-6 py-4">
                    No existe ningún registro coincidente
                </div>
            @endif


        </x-table>
    </div>
@endsection
