<div class="container mx-auto py-4 max-w-7xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Pagos Web</h4>
        {{-- <div class="flex-col sm:flex-row inline-flex">
            @can('cliente.lote')
                <a href="{{ route('cliente.carga-lote') }}" class="btn btn-verde btn-xs sm:btn-sm mr-4">Cargar Lote</a>
            @endcan
        </div> --}}
        @can('pago.web')
            <a href="{{ route('pago.web') }}"
                class="btn btn-red btn-xs sm:btn-sm mr-4 text-center mt-1 sm:mt-0">Regresar</a>
        @endcan
    </div>
    <x-table>
        <div class="px-6 py-4 flex items-center justify-between">

            <div class="flex-1">
                {{-- <span>Mostrar</span> --}}
                <select name="" id="" wire:model="pagination"
                    class="form-control mr-1 sm:mr-2 md:mr-4 text-xs">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>

            <x-jet-input type="text" wire:model="search" class="mr-4 text-xs sm:text-sm w-full"
                placeholder="Escriba lo que quiera buscar" />

            {{-- @livewire('create-post') --}}
        </div>

        @if ($pago_webs->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('pago_web')">
                            número<sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>

                            @if ($sort == 'pago_web')
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
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            fecha

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
                            class="hidden md:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            tipo

                        </th>
                        <th scope="col"
                            class="hidden lg:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('num_referencia')">
                            referencia

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
                            class="w-auto relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            monto
                        </th>
                        <th scope="col"
                            class="w-auto relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($pago_webs as $pago_web)
                        <tr>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $pago_web->pago_web }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    @php
                                        echo date_format($pago_web->created_at, 'd-m-Y');
                                    @endphp
                                </span>
                            </td>

                            <td class="hidden sm:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    {{ $pago_web->cliente->nombres }} {{ $pago_web->cliente->apellidos }}
                                </span>
                            </td>

                            <td class="hidden md:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    @if ($pago_web->tipo_pago == 'P')
                                        Pago Móvil
                                    @elseif ($pago_web->tipo_pago == 'T')
                                        Transferencia
                                    @endif
                                </span>
                            </td>

                            <td class="hidden lg:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    {{ $pago_web->znum_referencia }}
                                </span>
                            </td>

                            <td class="hidden lg:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    @php
                                        echo number_format($pago_web->monto, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-center">
                                @if (Auth::check())
                                    <div
                                        class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">
                                        @can('pago.show')
                                            <a class="btn btn-xs sm:btn-sm btn-show"
                                                href="{{ route('pago.show-pago-web', ['pago_web' => $pago_web->id]) }}"
                                                title="Registrar pago"><i class="fa-regular fa-eye"></i></a>
                                        @endcan

                                        {{-- @can('cliente.show')
                                        <a class="btn btn-xs sm:btn-sm btn-show mt-1 sm:mt-0 ml-0 sm:ml-1"
                                            href="{{ route('cliente.show', ['cliente' => $cliente->id]) }}"
                                            title="Ver"><i class="fa-regular fa-eye"></i></a>
                                    @endcan

                                    @can('cliente.equipo')
                                        <a class="btn btn-xs sm:btn-sm btn-carmesi mt-1 sm:mt-0 ml-0 sm:ml-1"
                                            href="{{ route('cliente.equipo', ['cliente' => $cliente->id]) }}"
                                            title="Asignar Equipo"><i class="fa-solid fa-wifi"></i></a>
                                    @endcan

                                    @can('cliente.cuenta')
                                        <a class="btn btn-xs sm:btn-sm btn-violeta mt-1 sm:mt-0 ml-0 sm:ml-1"
                                            href="{{ route('cliente.cuenta', ['cliente' => $cliente->id]) }}"
                                            title="Estado de Cuenta"><i class="far fa-money-bill-alt"></i></a>
                                    @endcan --}}

                                        {{-- @can('cliente.destroy')
                                        <button class="btn btn-xs sm:btn-sm btn-destroy mt-1 sm:ml-1 sm:mt-0"
                                            onclick="confirmation()" title="Eliminar"><i
                                                class="fa-regular fa-trash-can"></i></button>
                                    @endcan --}}
                                    </div>
                                    {{-- <form action="{{ route('cliente.show-destroy', ['cliente' => $cliente->id]) }}"
                                        method='GET'>


                                    </form> --}}
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <!-- More people... -->
                </tbody>
            </table>

            @if ($pago_webs->hasPages())
                <div class="px-6 py-3">
                    {{ $pago_webs->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
