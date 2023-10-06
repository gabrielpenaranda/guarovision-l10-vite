<div class="container mx-auto py-4 max-w-7xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Comprobantes de Consumo</h4>
        {{-- @can('recibo.create')
            <a href="{{ route('recibo.create') }}" class="btn btn-new btn-xs sm:btn-sm mr-4">Nuevo</a>
        @endcan --}}
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
                    <option value="1">Nº Consumo</option>
                    <option value="2">Cliente</option>
                    <option value="3">Monto</option>
                    <option value="4">Saldo</option>
                </select>
            </div>

            <x-jet-input type="text" wire:model="search" class="mt-5 sm:ml-4 mr-4 text-xs sm:text-sm w-full"
                placeholder="Escriba lo que quiera buscar" />

            {{-- @livewire('create-post') --}}
        </div>

        @if ($recibos->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>

                        <th scope="col"
                            class="w-auto hidden sm:table-cell sm:w-72 px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
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
                            class="w-auto sm:w-72 px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('numero')">
                            número<sup><i class="fa-solid fa-magnifying-glass"></i></sup>

                            @if ($sort == 'numero')
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
                            class="w-auto hidden sm:table-cell sm:w-72 px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
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
                            class="w-auto hidden sm:table-cell sm:w-72 px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            monto

                        </th>
                        <th scope="col"
                            class="w-auto hidden lg:table-cell sm:w-72 px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('saldo')">
                            saldo

                            @if ($sort == 'saldo')
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
                            class="relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($recibos as $recibo)
                        <tr>
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    @php
                                        echo date('d-m-Y', strtotime($recibo->fecha));
                                    @endphp
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $recibo->numero }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{-- @can('cliente.cuenta')
                                        <a href="{{ route('recibo.cuenta', ['cliente' => $recibo->cliente->id]) }}"><i
                                                class="fa-regular fa-eye mr-2 text-show text-xs"></i></a>
                                    @endcan --}}
                                    {{ $recibo->cliente->apellidos }}, {{ $recibo->cliente->nombres }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    @php
                                        echo $recibo->divisa->simbolo . ' ' . number_format($recibo->monto_divisa, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden lg:table-cell">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{-- @if ($recibo->pagada)
                                        <i class="fa-solid fa-check text-xs sm:text-sm"></i>
                                    @endif --}}
                                    @php
                                        echo $recibo->divisa->simbolo . ' ' . number_format($recibo->saldo, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-center">
                                @if (Auth::check())
                                    <div
                                        class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">
                                        @can('recibo.show')
                                            <a class="btn btn-xs sm:btn-sm btn-show"
                                                href="{{ route('recibo.show', ['recibo' => $recibo->id]) }}"
                                                title="Ver"><i class="fa-regular fa-eye"></i></a>
                                        @endcan

                                        @can('cliente.cuenta')
                                            <a class="btn btn-xs sm:btn-sm btn-violeta mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                href="{{ route('recibo.cuenta', ['cliente' => $recibo->cliente->id]) }}"
                                                title="Estado de Cuenta"><i class="far fa-money-bill-alt"></i></a>
                                        @endcan

                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <!-- More people... -->
                </tbody>
            </table>

            @if ($recibos->hasPages())
                <div class="px-6 py-3">
                    {{ $recibos->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
