<div class="container mx-auto py-4 max-w-4xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Conceptos</h4>
        @can('concepto.create')
            <a href="{{ route('concepto.create') }}" class="btn btn-new btn-xs sm:btn-sm mr-4">Nuevo</a>
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
                </select>
            </div>

            <x-jet-input type="text" wire:model="search" class="mr-4 text-xs sm:text-sm w-full"
                placeholder="Escriba lo que quiera buscar" />

            {{-- @livewire('create-post') --}}
        </div>

        @if ($conceptos->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('concepto')">
                            concepto<sup><i class="fa-solid fa-magnifying-glass"></i></sup>

                            @if ($sort == 'concepto')
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
                            descripción

                        </th>
                        <th scope="col"
                            class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            tarífa

                        </th>
                        {{-- <th scope="col"
                            class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                            requiere cantidad

                        </th> --}}
                        {{-- <th scope="col"
                            class="w-auto hidden sm:table-cell relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            impuesto
                        </th> --}}
                        <th scope="col"
                            class="w-auto relative px-6 py-3 text-center text-xs font-medium uppercase text-gray-500 tracking-normal">
                            acciones
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">

                    @foreach ($conceptos as $concepto)
                        <tr>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    {{ $concepto->concepto }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $concepto->descripcion }}
                                </span>
                            </td>
                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @php
                                        echo $concepto->divisa->simbolo . '  ' . number_format($concepto->tarifa, 2, ',', '.');
                                    @endphp
                                </span>
                            </td>

                            {{-- <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    @if ($concepto->cantidad)
                                        <i class="fa-solid fa-check text-xs sm:text-sm"></i>
                                    @endif
                                </span>
                            </td> --}}

                            {{-- <td class="px-6 py-4 hidden sm:table-cell">
                                @foreach ($concepto->impuestos as $impuesto)
                                    <span
                                        class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                        {{ $impuesto->impuesto }} ({{ $impuesto->tasa }}%)
                                    </span>
                                @endforeach
                            </td> --}}

                            <td class="px-6 py-4 text-sm font-medium text-center">
                                @if (Auth::check())
                                    <form action="{{ route('concepto.show-destroy', ['concepto' => $concepto->id]) }}"
                                        method='GET'>

                                        <div
                                            class="align-middle content-between flex-col sm:flex-row inline-flex sm:justify-between">

                                            @can('concepto.edit')
                                                <a class="btn btn-xs sm:btn-sm btn-edit"
                                                    href="{{ route('concepto.edit', ['concepto' => $concepto->id]) }}"
                                                    title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                            @endcan


                                            @can('concepto.show')
                                                <a class="btn btn-xs sm:btn-sm btn-show mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                    href="{{ route('concepto.show', ['concepto' => $concepto->id]) }}"
                                                    title="Ver"><i class="fa-regular fa-eye"></i></a>
                                            @endcan

                                            {{-- @can('concepto.impuesto')
                                                <a class="btn btn-xs sm:btn-sm btn-carmesi mt-1 sm:mt-0 ml-0 sm:ml-1"
                                                    href="{{ route('concepto.impuesto', ['concepto' => $concepto->id]) }}"
                                                    title="Asignar impuestos"><i class="fa-regular fa-i"></i></a>
                                            @endcan --}}

                                            @can('concepto.destroy')
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

            @if ($conceptos->hasPages())
                <div class="px-6 py-3">
                    {{ $conceptos->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
