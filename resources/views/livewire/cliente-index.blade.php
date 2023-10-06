<div class="container mx-auto py-4 max-w-7xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Clientes</h4>
        <div class="flex-col sm:flex-row inline-flex">
            @can('cliente.lote')
                @if (!auth()->user()->otro)
                    <a href="{{ route('cliente.carga-lote') }}" class="btn btn-verde btn-xs sm:btn-sm mr-4">Cargar Lote</a>
                @endif
            @endcan
            @can('cliente.create')
                <a href="{{ route('cliente.create') }}"
                    class="btn btn-new btn-xs sm:btn-sm mr-4 text-center mt-1 sm:mt-0">Nuevo</a>
            @endcan
        </div>
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

            @if (!auth()->user()->otro)
                <x-jet-input type="text" wire:model="search" class="mr-4 text-xs sm:text-sm w-full"
                    placeholder="Escriba lo que quiera buscar" />
            @endif

            {{-- @livewire('create-post') --}}
        </div>

        @if ($clientes->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('apellidos')">
                            apellidos
                            @if (!auth()->user()->otro)
                                <sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>
                            @endif

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
                            nombres
                            @if (!auth()->user()->otro)
                                <sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>
                            @endif

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
                            c.i.
                            @if (!auth()->user()->otro)
                                <sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>
                            @endif

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
                            email
                            @if (!auth()->user()->otro)
                                <sup><i class="fa-solid fa-magnifying-glass z-0"></i></sup>
                            @endif

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
                                    <form action="{{ route('cliente.show-destroy', ['cliente' => $cliente->id]) }}"
                                        method='GET'>

                                        <div
                                            class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">
                                            @can('cliente.edit')
                                                <a class="btn btn-xs sm:btn-sm btn-edit"
                                                    href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}"
                                                    title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @endcan

                                            @can('cliente.show')
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
                                            @endcan

                                            @can('cliente.destroy')
                                                <button class="btn btn-xs sm:btn-sm btn-destroy mt-1 sm:ml-1 sm:mt-0"
                                                    onclick="confirmation()" title="Eliminar"><i
                                                        class="fa-regular fa-trash-can"></i></button>
                                            @endcan
                                        </div>

                                    </form>
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
