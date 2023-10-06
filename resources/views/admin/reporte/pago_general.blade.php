@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-4 max-w-7xl">

        <div class="flex pb-2 items-center justify-between">
            <h4 class="titulo">Reporte de Pagos</h4>
        </div>

        {{-- Seleccion de fecha --}}
        <x-table>
            <form action="{{ route('reporte.pago-general') }}" method="POST">
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

        {{-- Totales clientes --}}
        <div x-cloak x-data="{ open: false }" class="bg-gray-50 py-6 flex flex-col overflow-hidden sm:py-12 max-w-7xl">
            <div @click="open = ! open" class="p-4 bg-blue-100 rounded flex justify-between items-center">
                <div class="flex items-center gap-2">

                    @if ($desde == '')
                        <h4 class="titulo">Clientes Insolventes</h4>
                    @else
                        <h4 class="titulo">Clientes Insolventes del {{ $desde }} al {{ $hasta }}</h4>
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
                    @if ($num_clientes_insolventes != null && count($recibo_totales) > 0)
                        <table class="min-w-full
                    divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        cliente
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        fecha
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        nº consumo
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
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                    $cliente = 0;
                                @endphp
                                @foreach ($recibo_totales as $rt)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                @if ($cliente != $rt->cliente_id)
                                                    {{ $rt->cliente->nombres }} {{ $rt->cliente->apellidos }} {{ $rt->cliente->cedula }}
                                                @endif
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                @php
                                                    echo date('d-m-Y', strtotime($rt->fecha));
                                                @endphp
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $rt->numero }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $rt->concepto }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($rt->monto_divisa, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($rt->saldo, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                    </tr>
                                    @php
                                        $cliente = $rt->cliente_id;
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
                                total clientes
                            </th>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer text-center">
                                total clientes solventes
                            </th>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer text-center">
                                total clientes insolventes
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>

                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $num_clientes }}
                                </span>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo $num_clientes - $num_clientes_insolventes;
                                    @endphp
                                </span>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $num_clientes_insolventes }}
                                </span>
                            </td>
                            @if ($recibo_totales != null)
                                <td class="px-6 py-4 hidden sm:table-cell text-center">
                                    <a href="{{ route('reporte.recibo-general-saldo', ['desde' => $desde, 'hasta' => $hasta]) }}"
                                        class="btn btn-verde btn-xs sm:btn-sm mr-4">Exportar</a>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </x-table>
        </div>

        {{-- Pagos por Taquilla --}}
        <div x-cloak x-data="{ open: false }" class="bg-gray-50 py-6 flex flex-col overflow-hidden sm:py-12 max-w-7xl">
            <div @click="open = ! open" class="p-4 bg-blue-100 rounded flex justify-between items-center">
                <div class="flex items-center gap-2">

                    @if ($desde == '')
                        <h4 class="titulo">Pagos por Taquilla</h4>
                    @else
                        <h4 class="titulo">Pagos por Taquilla del {{ $desde }} al {{ $hasta }}</h4>
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
                        $monto_bs = 0;
                        $monto_divisa = 0;
                        $monto_pos = 0;
                    @endphp
                    @if ($pago_taquillas != null && count($pago_taquillas) > 0)
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
                                        nº pago
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        cliente
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        efectivo bs
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        efectivo divisa
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        pos
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        banco
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($pago_taquillas as $pago_taquilla)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                @php
                                                    echo date_format($pago_taquilla->created_at, 'd-m-Y');
                                                @endphp
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                {{ $pago_taquilla->pago_taquilla }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_taquilla->cliente->nombres }}
                                                {{ $pago_taquilla->cliente->apellidos }} {{ $pago_taquilla->cliente->cedula }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($pago_taquilla->monto_efectivo_bs, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($pago_taquilla->monto_efectivo_divisa, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($pago_taquilla->monto_pos, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @if ($pago_taquilla->monto_pos > 0)
                                                    {{ $pago_taquilla->banco_pos->banco }}
                                                @endif
                                            </span>
                                        </td>
                                    </tr>
                                    @php
                                        $monto_bs += $pago_taquilla->monto_efectivo_bs;
                                        $monto_divisa += $pago_taquilla->monto_efectivo_divisa;
                                        $monto_pos += $pago_taquilla->monto_pos;
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
                                total efectivo bs
                            </th>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer text-center">
                                total efectivo divisa
                            </th>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer text-center">
                                total pos
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>

                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($monto_bs, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($monto_divisa, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($monto_pos, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            @if ($pago_taquillas != null)
                                <td class="px-6 py-4 hidden sm:table-cell text-center">
                                    <a href="{{ route('reporte.pago-general-taquilla', ['desde' => $desde, 'hasta' => $hasta]) }}"
                                        class="btn btn-verde btn-xs sm:btn-sm mr-4">Exportar</a>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </x-table>
        </div>

        {{-- Pagos Web Confirmados --}}
        <div x-cloak x-data="{ open: false }" class="bg-gray-50 py-6 flex flex-col overflow-hidden sm:py-12 max-w-7xl">
            <div @click="open = ! open" class="p-4 bg-blue-100 rounded flex justify-between items-center">
                <div class="flex items-center gap-2">

                    @if ($desde == '')
                        <h4 class="titulo">Pagos Web Confirmados</h4>
                    @else
                        <h4 class="titulo">Pagos Web Confirmados del {{ $desde }} al {{ $hasta }}</h4>
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
                        $monto_bs_confirmado = 0;
                    @endphp
                    @if ($pago_web_confirmados != null && count($pago_web_confirmados) > 0)
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
                                        nº pago
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        cliente
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        monto bs
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        banco origen
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        banco destino
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($pago_web_confirmados as $pago_web_confirmado)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                @php
                                                    echo date_format($pago_web_confirmado->created_at, 'd-m-Y');
                                                @endphp
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                {{ $pago_web_confirmado->pago_web }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_confirmado->cliente->nombres }}
                                                {{ $pago_web_confirmado->cliente->apellidos }} {{ $pago_web_confirmado->cliente->cedula }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($pago_web_confirmado->monto, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_confirmado->banco_origen->banco }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_confirmado->banco_destino->banco }}
                                            </span>
                                        </td>
                                    </tr>
                                    @php
                                        $monto_bs_confirmado += $pago_web_confirmado->monto;
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
                                total bs
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($monto_bs_confirmado, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            @if ($pago_web_confirmados != null)
                                <td class="px-6 py-4 hidden sm:table-cell text-center">
                                    <a href="{{ route('reporte.pago-general-confirmado', ['desde' => $desde, 'hasta' => $hasta]) }}"
                                        class="btn btn-verde btn-xs sm:btn-sm mr-4">Exportar</a>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </x-table>
        </div>

        {{-- Pagos Web Conciliados --}}
        <div x-cloak x-data="{ open: false }" class="bg-gray-50 py-6 flex flex-col overflow-hidden sm:py-12 max-w-7xl">
            <div @click="open = ! open" class="p-4 bg-blue-100 rounded flex justify-between items-center">
                <div class="flex items-center gap-2">

                    @if ($desde == '')
                        <h4 class="titulo">Pagos Web Conciliados</h4>
                    @else
                        <h4 class="titulo">Pagos Web Conciliados del {{ $desde }} al {{ $hasta }}</h4>
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
                        $monto_bs_conciliado = 0;
                    @endphp
                    @if ($pago_web_conciliados != null && count($pago_web_conciliados) > 0)
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
                                        nº pago
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        cliente
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        efectivo bs
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        efectivo divisa
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        pos
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        banco
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($pago_web_conciliados as $pago_web_conciliado)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                @php
                                                    echo date_format($pago_web_conciliado->created_at, 'd-m-Y');
                                                @endphp
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                {{ $pago_web_conciliado->pago_web }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_conciliado->cliente->nombres }}
                                                {{ $pago_web_conciliado->cliente->apellidos }} {{ $pago_web_conciliado->cliente->cedula }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($pago_web_conciliado->monto, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_conciliado->banco_origen->banco }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_conciliado->banco_destino->banco }}
                                            </span>
                                        </td>
                                    </tr>
                                    @php
                                        $monto_bs_conciliado += $pago_web_conciliado->monto;
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
                                total bs
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($monto_bs_conciliado, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            @if ($pago_web_conciliados != null)
                                <td class="px-6 py-4 hidden sm:table-cell text-center">
                                    <a href="{{ route('reporte.pago-general-conciliado', ['desde' => $desde, 'hasta' => $hasta]) }}"
                                        class="btn btn-verde btn-xs sm:btn-sm mr-4">Exportar</a>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </x-table>
        </div>

        {{-- Pagos Web No Confirmados Ni Conciliados --}}
        <div x-cloak x-data="{ open: false }" class="bg-gray-50 py-6 flex flex-col overflow-hidden sm:py-12 max-w-7xl">
            <div @click="open = ! open" class="p-4 bg-blue-100 rounded flex justify-between items-center">
                <div class="flex items-center gap-2">

                    @if ($desde == '')
                        <h4 class="titulo">Pagos Web No Confirmados Ni Conciliados</h4>
                    @else
                        <h4 class="titulo">Pagos Web No Confirmados Ni Conciliados del {{ $desde }} al
                            {{ $hasta }}</h4>
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
                        $monto_bs_recibido = 0;
                    @endphp
                    @if ($pago_web_recibidos != null && count($pago_web_recibidos) > 0)
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
                                        nº pago
                                    </th>
                                    <th scope="col"
                                        class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        cliente
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        efectivo bs
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        efectivo divisa
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        pos
                                    </th>
                                    <th scope="col"
                                        class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                        banco
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach ($pago_web_recibidos as $pago_web_recibido)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                @php
                                                    echo date_format($pago_web_recibido->created_at, 'd-m-Y');
                                                @endphp
                                            </span>
                                        </td>

                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                {{ $pago_web_recibido->pago_web }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_recibido->cliente->nombres }}
                                                {{ $pago_web_recibido->cliente->apellidos }} {{ $pago_web_recibido->cliente->cedula }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell text-right">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo number_format($pago_web_recibido->monto, 2, ',', '.');
                                                @endphp
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_recibido->banco_origen->banco }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $pago_web_recibido->banco_destino->banco }}
                                            </span>
                                        </td>
                                    </tr>
                                    @php
                                        $monto_bs_recibido += $pago_web_recibido->monto;
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
                                total bs
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 hidden sm:table-cell text-center">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo number_format($monto_bs_recibido, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            @if ($pago_web_recibidos != null)
                                <td class="px-6 py-4 hidden sm:table-cell text-center">
                                    <a href="{{ route('reporte.pago-general-recibido', ['desde' => $desde, 'hasta' => $hasta]) }}"
                                        class="btn btn-verde btn-xs sm:btn-sm mr-4">Exportar</a>
                                </td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </x-table>
        </div>

    </div>

@endsection
