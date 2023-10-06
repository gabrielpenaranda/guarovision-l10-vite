<div class="container mx-auto py-4 max-w-7xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Pagos por Taquilla</h4>
    </div>

    <x-table>

        <div class="px-6 py-4 flex items-center justify-between">

            <div class="flex-1 sm:mt-0 sm:ml-4">
                    <label for="inicio" class="form-label">Fecha desde</label>
                    <input type="date" name="inicio" class="form-control w-full" wire:model="desde"/>
                </div>

                <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                    <label for="final" class="form-label">Fecha hasta</label>
                    <input type="date" name="final" class="form-control" wire:model="hasta"/>
                </div>

            <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                <label for="final" class="form-label">Elementos</label>
                <select name="" id="" wire:model="pagination"
                    class="form-control text-xs">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="250">250</option>
                    <option value="500">500</option>
                </select>
            </div>

            <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                <label for="final" class="form-label">Busqueda por</label>
                <select name="" id="" wire:model="criterio"
                    class="form-control text-xs">
                    <option value="0">--</option>
                    <option value="1">Nº Pago</option>
                    <option value="2">Cliente</option>
                    <option value="3">Monto</option>
                </select>
            </div>

            <x-jet-input type="text" wire:model="search" class="mt-5 sm:ml-4 mr-4 text-xs sm:text-sm w-full"
                placeholder="Escriba lo que quiera buscar" />

            {{-- @livewire('create-post') --}}
        </div>

        @if ($pago_taquillas->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('created_at')">
                            fecha

                            @if ($sort == 'created_at')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('pago_taquilla')">
                            numero<sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>

                            @if ($sort == 'pago_taquilla')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="hidden sm:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('cliente_id')">
                            cliente

                            @if ($sort == 'cliente_id')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="hidden md:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('monto_total')">
                            monto

                            @if ($sort == 'monto_total')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="w-auto relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($pago_taquillas as $pago_taquilla)
                        <tr>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    @php
                                        echo date_format($pago_taquilla->created_at, 'd-m-Y');
                                    @endphp
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $pago_taquilla->pago_taquilla }}
                                </span>
                            </td>

                            <td class="hidden sm:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    {{ $pago_taquilla->cliente->nombres }} {{ $pago_taquilla->cliente->apellidos }}
                                </span>
                            </td>

                            <td class="hidden md:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    @php
                                        echo number_format($pago_taquilla->monto_total, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-center">
                                @if (Auth::check())
                                    <div
                                        class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">
                                        @can('pagos-web.web-show')
                                            <a class="btn btn-xs sm:btn-sm btn-show"
                                                href="{{ route('pagos-taquilla.taquilla-show', ['pagos_taquilla' => $pago_taquilla->id]) }}"
                                                title="Registrar pago"><i class="fa-regular fa-eye"></i></a>
                                        @endcan

                                        {{-- @can('pago_taquilla.show')
                                        <a class="btn btn-xs sm:btn-sm btn-show mt-1 sm:mt-0 ml-0 sm:ml-1"
                                            href="{{ route('pago_taquilla.show', ['pago_taquilla' => $pago_taquilla->id]) }}"
                                            title="Ver"><i class="fa-regular fa-eye"></i></a>
                                    @endcan

                                    @can('pago_taquilla.equipo')
                                        <a class="btn btn-xs sm:btn-sm btn-carmesi mt-1 sm:mt-0 ml-0 sm:ml-1"
                                            href="{{ route('pago_taquilla.equipo', ['pago_taquilla' => $pago_taquilla->id]) }}"
                                            title="Asignar Equipo"><i class="fa-solid fa-wifi"></i></a>
                                    @endcan

                                    @can('pago_taquilla.cuenta')
                                        <a class="btn btn-xs sm:btn-sm btn-violeta mt-1 sm:mt-0 ml-0 sm:ml-1"
                                            href="{{ route('pago_taquilla.cuenta', ['pago_taquilla' => $pago_taquilla->id]) }}"
                                            title="Estado de Cuenta"><i class="far fa-money-bill-alt"></i></a>
                                    @endcan --}}

                                        {{-- @can('pago_taquilla.destroy')
                                        <button class="btn btn-xs sm:btn-sm btn-destroy mt-1 sm:ml-1 sm:mt-0"
                                            onclick="confirmation()" title="Eliminar"><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    @endcan --}}
                                    </div>
                                    {{-- <form action="{{ route('pago_taquilla.show-destroy', ['pago_taquilla' => $pago_taquilla->id]) }}"
                                        method='GET'>


                                    </form> --}}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <!-- More people... -->
                </tbody>
            </table>

            @if ($pago_taquillas->hasPages())
                <div class="px-6 py-3">
                    {{ $pago_taquillas->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
