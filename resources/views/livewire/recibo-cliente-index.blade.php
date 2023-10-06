<div class="container mx-auto py-4 max-w-7xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Clientes</h4>
        {{-- <div class="flex-col sm:flex-row inline-flex">
            @can('cliente.lote')
                <a href="{{ route('cliente.carga-lote') }}" class="btn btn-verde btn-xs sm:btn-sm mr-4">Cargar Lote</a>
            @endcan
            @can('cliente.create')
                <a href="{{ route('cliente.create') }}"
                    class="btn btn-new btn-xs sm:btn-sm mr-4 text-center mt-1 sm:mt-0">Nuevo</a>
            @endcan
        </div> --}}
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

        @if ($clientes->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('apellidos')">
                            apellidos<sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>

                            @if ($sort == 'apellidos')
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
                            wire:click="order('nombres')">
                            nombres<sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>

                            @if ($sort == 'nombres')
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
                            wire:click="order('cedula')">
                            c.i.<sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>

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
                            class="hidden md:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('email')">
                            email<sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>

                            @if ($sort == 'email')
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
                            class="hidden lg:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            zona

                        </th>
                        <th scope="col"
                            class="hidden lg:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            plan

                        </th>
                        <th scope="col"
                            class="w-auto relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($clientes as $cliente)
                        <tr>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $cliente->apellidos }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $cliente->nombres }}
                                </span>
                            </td>

                            <td class="hidden sm:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    {{ $cliente->cedula }}
                                </span>
                            </td>

                            <td class="hidden md:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    {{ $cliente->email }}
                                </span>
                            </td>

                            <td class="hidden lg:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    {{ $cliente->zona->zona }}
                                </span>
                            </td>

                            <td class="hidden lg:table-cell px-6 py-4">
                                <span class="px-2 text-xs sm:text-sm leading-5 font-semibold">
                                    {{ $cliente->plan->plan }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-center">
                                @if (Auth::check())
                                    <div
                                        class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">
                                        @if ($cliente->activo)
                                            @can('recibo.recibo')
                                                <a class="btn btn-xs sm:btn-sm btn-violeta"
                                                    href="{{ route('recibo.recibo', ['cliente' => $cliente->id]) }}"
                                                    title="Registrar"><i
                                                        class="fa-solid fa-file-invoice-dollar"></i></i></a>
                                            @endcan
                                        @endif
                                        @can('recibo.exonera')
                                            <a class="btn btn-xs sm:btn-sm btn-carmesi mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                href="{{ route('recibo.exonera', ['cliente' => $cliente->id]) }}"
                                                title="Exonerar"><i class="fa-solid fa-money-bill-wave"></i></i></i></a>
                                        @endcan
                                        @can('recibo.exonera')
                                            <a class="btn btn-xs sm:btn-sm btn-dark mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                href="{{ route('recibo.exonera-reverso', ['cliente' => $cliente->id]) }}"
                                                title="Reversar Exonerar"><i class="fa-regular fa-circle-left"></i></a>
                                        @endcan
                                        @if ($cliente->activo)
                                            @can('recibo.recibo')
                                                <a class="btn btn-xs sm:btn-sm btn-verde mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                    href="{{ route('recibo.create-debito', ['cliente' => $cliente->id]) }}"
                                                    title="Nota de Débito"><i class="fa-solid fa-note-sticky"></i></a>
                                            @endcan
                                        @endif
                                        @if ($cliente->activo)
                                            @can('recibo.recibo')
                                                <a class="btn btn-xs sm:btn-sm btn-edit mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                    href="{{ route('recibo.create-credito', ['cliente' => $cliente->id]) }}"
                                                    title="Nota de Crédito"><i class="fa-solid fa-note-sticky"></i></a>
                                            @endcan
                                        @endif

                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    <!-- More people... -->
                </tbody>
            </table>

            @if ($clientes->hasPages())
                <div class="px-6 py-3">
                    {{ $clientes->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
