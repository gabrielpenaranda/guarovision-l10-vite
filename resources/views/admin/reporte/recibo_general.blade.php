@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-4 max-w-7xl">

        <div class="flex pb-2 items-center justify-between">
            <h4 class="titulo">Reporte de Consumos</h4>

            @if ($recibos != null)
                <a href="{{ route('reporte.recibo-general-recibo', ['desde' => $desde, 'hasta' => $hasta]) }}"
                    class="btn btn-verde btn-xs sm:btn-sm mr-4">Exportar</a>
            @endif
        </div>

        {{-- Seleccion de fecha --}}
        <x-table>
            <form action="{{ route('reporte.recibo-general') }}" method="POST">
                @csrf
                <div class="px-6 py-4 align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">

                    <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                        <label for="inicio" class="form-label">Fecha desde</label>
                        <input type="date" name="inicio" class="form-control w-full" />
                    </div>

                    <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                        <label for="final" class="form-label">Fecha hasta</label>
                        <input type="date" name="final" class="form-control" />
                    </div>

                    <div class="flex-1 mt-2 sm:mt-6 sm:ml-4">
                        <button type="submit" class="btn btn-edit btn-xs sm:btn-sm mr-4">Buscar</button>
                    </div>
                </div>
            </form>

        </x-table>


        {{-- Consumos --}}
        <div x-cloak x-data="{ open: false }" class="bg-gray-50 py-6 flex flex-col overflow-hidden sm:py-12 max-w-7xl">
            <div @click="open = ! open" class="p-4 bg-blue-100 rounded flex justify-between items-center">
                <div class="flex items-center gap-2">

                    @if ($desde == '')
                        <h4 class="titulo">Consumos</h4>
                    @else
                        <h4 class="titulo">Consumos del {{ $desde }} al {{ $hasta }}</h4>
                    @endif

                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-0" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-10"
                x-transition:leave-end="opacity-0 translate-y-0" class="bg-white p-4 ">

                <x-table>
                    @php
                        $acum_monto = 0;
                        $acum_saldo = 0;
                        $acum_exento = 0;
                    @endphp
                    @if ($recibos != null && count($recibos) > 0)
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
                                        nº consumo
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        cliente
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        concepto
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        monto
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        saldo
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        exento
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($recibos as $recibo)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                @php
                                                    echo date_format($recibo->created_at, 'd-m-Y');
                                                @endphp
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                {{ $recibo->numero }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $recibo->cliente->nombres }}
                                                {{ $recibo->cliente->apellidos }} {{ $recibo->cliente->cedula }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $recibo->concepto }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($recibo->monto_divisa, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($recibo->saldo, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @if ($recibo->exento)
                                                    <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    @php
                                        $acum_monto += $recibo->monto_divisa;
                                        $acum_saldo += $recibo->saldo;
                                        if ($recibo->exento) {
                                            $acum_exento += $recibo->monto_divisa;
                                        }
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    @else
                        <div class="px-6 py-4">
                            No existe ningún registro coincidente
                        </div>
                    @endif

                </x-table>

            </div>
            <x-table>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer text-center">
                                total consumos
                            </th>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer text-center">
                                total cobrado
                            </th>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer text-center">
                                total exento
                            </th>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer text-center">
                                total pendiente
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>

                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($acum_monto, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        $cobrado = $acum_monto - $acum_exento - $acum_saldo;
                                        echo number_format($cobrado, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($acum_exento, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($acum_saldo, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </x-table>
        </div>

    </div>


@endsection
