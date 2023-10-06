<div class="container mx-auto py-4 max-w-7xl">
    <div class="flex pb-2 items-center justify-between">
        <h4 class="titulo">Logs</h4>
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

        @if ($logs->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('created_at')">
                            fecha

                            @if ($sort == 'created_at')
                                @if ($direction == 'desc')
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
                            wire:click="order('description')">
                            acción

                            @if ($sort == 'description')
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
                            wire:click="order('table_name')">
                            tabla<sup><i class="fa-solid fa-magnifying-glass"></i></sup>

                            @if ($sort == 'table_name')
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
                            wire:click="order('user_name')">
                            usuario<sup><i class="fa-solid fa-magnifying-glass"></i></sup>

                            @if ($sort == 'user_name')
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
                            class=" hidden sm:table-cell w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer"
                            wire:click="order('identification')">
                            C.I.<sup><i class="fa-solid fa-magnifying-glass"></i></sup>

                            @if ($sort == 'identification')
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

                    @foreach ($logs as $log)
                        <tr>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                    @php
                                        echo date('d/m/Y', strtotime($log->created_at));
                                    @endphp
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $log->description }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $log->table_name }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $log->user_name }}
                                </span>
                            </td>

                            <td class="px-6 py-4 hidden sm:table-cell">
                                <span
                                    class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                    {{ $log->identification }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-sm font-medium text-center">
                                @can('log.show')
                                    <a class="btn btn-xs sm:btn-sm btn-show mt-1 sm:mt-0 ml-0 sm:ml-1"
                                        href="{{ route('log.show', ['log' => $log->id]) }}" title="Ver"><i
                                            class="fa-regular fa-eye"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach

                    <!-- More people... -->
                </tbody>
            </table>

            @if ($logs->hasPages())
                <div class="px-6 py-3">
                    {{ $logs->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-4">
                No existe ningún registro coincidente
            </div>
        @endif


    </x-table>
</div>
