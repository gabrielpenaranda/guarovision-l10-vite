<div class="container mx-auto py-4 max-w-7xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Equipos</h4>
        <div class="flex-col sm:flex-row inline-flex">
            @can('equipo.lote')
                    <a href="{{ route('equipo.carga-lote') }}" class="btn btn-verde btn-xs sm:btn-sm mr-4">Cargar Lote</a>
                @endcan
            @can('equipo.create')
                <a href="{{ route('equipo.create') }}" class="btn btn-new btn-xs sm:btn-sm mr-4 text-center mt-1 sm:mt-0">Nuevo</a>
            @endcan
        </div>
    </div>
    <x-table>
        <div class="px-6 py-4 flex items-center justify-between">

            <div class="flex-1">
                {{-- <span>Mostrar</span> --}}
                <select name="" id="" wire:model="pagination" class="form-control mr-1 sm:mr-2 md:mr-4 text-xs">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>

            <x-jet-input type="text" wire:model="search" class="mr-4 text-xs sm:text-sm w-full"
                placeholder="Escriba lo que quiera buscar" />

            {{-- @livewire('create-post') --}}
        </div>

        @if ($equipos->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="block sm:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('modelo_equipo_id')">
                            modelo

                            @if ($sort == 'modelo_equipo_id')
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
                            class="block lg:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('serial')">
                            serial<sup><i class="fa-solid fa-magnifying-glass"></i></sup>

                            @if ($sort == 'serial')
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
                            class="block lg:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('pon')">
                            pon<sup><i class="fa-solid fa-magnifying-glass"></i></sup>

                            @if ($sort == 'pon')
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
                            class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            tipo-marca

                        </th>
                        <th scope="col"
                            class="w-auto hidden lg:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            asignado

                        </th>
                        <th scope="col"
                            class="w-auto relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($equipos as $equipo)
                        <tr>
                            <td class="px-6 py-4 block sm:table-cell">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $equipo->modelo_equipo->modelo_equipo }}
                                </span>
                            </td>

                            <td class="px-6 py-4 block lg:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $equipo->serial }}
                                </span>
                            </td>

                            <td class="px-6 py-4 block lg:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $equipo->pon }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $equipo->modelo_equipo->tipo_equipo->tipo_equipo }}-{{ $equipo->modelo_equipo->marca_equipo->marca_equipo }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden lg:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @if ($equipo->asignado)
                                        <i class="fa-solid fa-check text-xs sm:text-sm"></i>
                                    @endif
                                </span>
                            </td>


                            <td class="px-6 py-4 text-sm font-medium text-center">
                                @if (Auth::check())
                                    <form action="{{ route('equipo.show-destroy', ['equipo' => $equipo->id]) }}"
                                        method='GET'>

                                        <div
                                            class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">

                                            @can('equipo.edit')
                                                <a class="btn btn-xs sm:btn-sm btn-edit"
                                                    href="{{ route('equipo.edit', ['equipo' => $equipo->id]) }}"
                                                    title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @endcan


                                            @can('equipo.show')
                                                <a class="btn btn-xs sm:btn-sm btn-show mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                    href="{{ route('equipo.show', ['equipo' => $equipo->id]) }}"
                                                    title="Ver"><i class="fa-regular fa-eye"></i></a>
                                            @endcan

                                            @can('equipo.destroy')
                                                <button class="btn btn-xs sm:btn-sm btn-destroy mt-1 sm:mt-0 ml-0 sm:ml-1"
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

            @if ($equipos->hasPages())
                <div class="px-6 py-3">
                    {{ $equipos->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
