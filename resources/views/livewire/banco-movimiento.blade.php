<div class="container mx-auto py-4 max-w-4xl">

    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Movimientos Bancarios</h4>
        @can('banco.create')
            <a href="{{ route('banco.carga-lote') }}" class="btn btn-verde btn-xs sm:btn-sm mr-4">Cargar Lote</a>
        @endcan
    </div>
    <x-table>
        <div class="px-6 py-4 align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">

            <div class="flex-1">
                <label for="inicio" class="form-label">Líneas</label>
                <select name="" id="" wire:model="pagination" class="form-control">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                <label for="inicio" class="form-label">Banco</label>
                <select name="" id="" wire:model="search" class="form-control">
                    @foreach ($bancos as $banco)
                        <option value="{{ $banco->id }}">{{ $banco->banco }}</option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="flex-1">
            </div> --}}
            <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                <label for="inicio" class="form-label">Fecha desde</label>
                <input type="date" wire:model="inicio" class="form-control w-full" wire:model="inicio" />
            </div>
            <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                <label for="inicio" class="form-label">Fecha hasta</label>
                <input type="date" wire:model="final" class="form-control" wire:model="final" />
            </div>
            <div class="flex-1 mt-2 sm:mt-0 sm:ml-4">
                <button class="btn btn-edit btn-xs sm:btn-sm mr-4" wire:click="busca_movimientos()">Buscar</button>
            </div>


            {{-- <x-jet-input type="text" wire:model="search" class="mr-4 text-xs sm:text-sm w-full"
                placeholder="Escriba lo que quiera buscar" /> --}}

            {{-- @livewire('create-post') --}}
        </div>

        @if ($movimiento_bancos->count())
            <table class="min-w-full
                    divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('fecha')">
                            fecha

                            @if ($sort == 'fecha')
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
                            wire:click="order('referencia')">
                            referencia

                            @if ($sort == 'referencia')
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
                            class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('cedula')">
                            cédula

                            @if ($sort == 'cedula')
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
                            class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('telefono')">
                            teléfono
                            @if ($sort == 'telefono')
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
                            class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('monto')">
                            monto Bs
                            @if ($sort == 'monto')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-a-z float-right mt-1"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-z-a float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        {{-- <th scope="col"
                            class="relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            acciones
                        </th> --}}
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($movimiento_bancos as $banco)
                        <tr>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    @php
                                        echo date_format($banco->fecha, 'd-m-Y');
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
                                    ($banco->telefono)
                                </span>
                            </td>


                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    ($banco->monto)
                                </span>
                            </td>

                            {{-- <td class="px-6 py-4 text-sm font-medium text-center">
                                @if (Auth::check())
                                    <form action="{{ route('banco.show-destroy', ['banco' => $banco->id]) }}"
                                        method='GET'>

                                        <div
                                            class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">
                                            @can('banco.edit')
                                                <a class="btn btn-xs sm:btn-sm btn-edit"
                                                    href="{{ route('banco.edit', ['banco' => $banco->id]) }}"
                                                    title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @endcan

                                            @can('banco.destroy')
                                                <button class="btn btn-xs sm:btn-sm btn-destroy mt-1 sm:ml-1 sm:mt-0"
                                                    onclick="confirmation()" title="Eliminar"><i
                                                        class="fa-regular fa-trash-can"></i></button>
                                            @endcan
                                        </div>

                                    </form>
                                @endif
                            </td> --}}
                        </tr>
                    @endforeach

                    <!-- More people... -->
                </tbody>
            </table>

            @if ($movimiento_bancos->hasPages())
                <div class="px-6 py-3">
                    {{ $bancos->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
