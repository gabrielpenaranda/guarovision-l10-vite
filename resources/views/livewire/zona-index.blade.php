<div class="container mx-auto py-4 max-w-4xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Zonas</h4>
        @can('zona.create')
            <a href="{{ route('zona.create') }}" class="btn btn-new btn-xs sm:btn-sm mr-4">Nuevo</a>
        @endcan
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

        @if ($zonas->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('id')">
                            id

                            @if ($sort == 'id')
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
                            wire:click="order('zona')">
                            zona<sup><i class="fa-solid fa-magnifying-glass"></i></sup>

                            @if ($sort == 'zona')
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
                            wire:click="order('ciudad_id')">
                            ciudad

                            @if ($sort == 'ciudad_id')
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
                            estado

                        </th>
                        <th scope="col"
                            class="w-auto relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($zonas as $zona)
                        <tr>
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $zona->id }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $zona->zona }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $zona->ciudad->ciudad }}-{{ $zona->ciudad->estado->estado }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $zona->ciudad->estado->estado }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-center">
                                @if (Auth::check())
                                    <form action="{{ route('zona.show-destroy', ['zona' => $zona->id]) }}"
                                        method='GET'>

                                        <div
                                            class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">

                                            @can('zona.edit')
                                                <a class="btn btn-xs sm:btn-sm btn-edit"
                                                    href="{{ route('zona.edit', ['zona' => $zona->id]) }}"
                                                    title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @endcan


                                            @can('zona.show')
                                                <a class="btn btn-xs sm:btn-sm btn-show mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                    href="{{ route('zona.show', ['zona' => $zona->id]) }}" title="Ver"><i
                                                        class="fa-regular fa-eye"></i></a>
                                            @endcan

                                            @can('zona.destroy')
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

            @if ($zonas->hasPages())
                <div class="px-6 py-3">
                    {{ $zonas->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
