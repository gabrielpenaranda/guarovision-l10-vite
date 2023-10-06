@extends('layouts.app')

@section('content')

    <div class="container mx-auto py-4 max-w-5xl">
        <div class="flex pb-2 items-center justify-between">
            <h4 class="titulo">Usuarios Eliminados</h4>
            @can('usuario.index')
                <a href="{{ route('usuario.index') }}" class="btn btn-back btn-xs sm:btn-sm">Regresar</a>
            @endcan
        </div>
        <x-table>

            @if ($deleted_users->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-auto px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                nombre completo
                            </th>
                            <th scope="col"
                                class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                email

                            </th>
                            <th scope="col"
                                class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                C.I.

                            </th>
                            <th scope="col"
                                class="w-auto hidden sm:table-cell px-6 py-3 text-left text-xs font-medium uppercase text-gray-500 tracking-normal cursor-pointer">
                                Fecha retiro
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($deleted_users as $user)
                            @if ($user->id != 1)
                                @if ($user->deleted)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold hl-table">
                                                {{ $user->name }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $user->email }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                {{ $user->identification }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 hidden sm:table-cell">
                                            <span
                                                class="px-2 inline-flex text-xs sm:text-sm leading-5 font-semibold table-highlighted">
                                                @php
                                                    echo date('d/m/Y', strtotime($user->date_to));
                                                @endphp
                                            </span>
                                        </td>

                                    </tr>
                                @endif
                            @endif
                        @endforeach

                        <!-- More people... -->
                    </tbody>
                </table>

                <div class="px-6 py-3">
                    {!! $deleted_users->render() !!}
                </div>
            @else
                <div class="px-6 py-4">
                    No existe ningún registro coincidente
                </div>
            @endif


        </x-table>
    </div>


@endsection
