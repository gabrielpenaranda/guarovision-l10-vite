@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            <h4 class="titulo">Cliente-Asignar Equipo</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('cliente.index') }}">Regresar</a>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">
            <form action="{{ route('cliente.store_equipo', ['cliente' => $cliente->id]) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="mt-4 mx-4">
                    <label for="equipo_id" class="form-label mb-4">Equipo asignado</label>
                    @if ($cliente->equipo_id != null)
                        <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit">
                            {{ $cliente->equipo->modelo_equipo->modelo_equipo }} PON: {{ $cliente->equipo->pon }}
                            SERIAL:
                            {{ $cliente->equipo->serial }}
                        </span>
                    @endif
                    <select name="equipo_id" class="form-control w-full mt-4">
                        <option value=""></option>
                        <option value="null">No asignar</option>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}">
                                {{ $equipo->modelo_equipo->modelo_equipo }} PON: {{ $equipo->pon }} SERIAL:
                                {{ $equipo->serial }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="mt-6 ml-4">
                    @can('cliente.equipo')
                        <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Asignar</button>
                    @endcan
                </div>
            </form>
        </div>

        <div class="bg-white pb-4 rounded-xl border-4">

            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Apellidos</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->apellidos }}
                </span>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Nombres</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->nombres }}
                </span>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">C.I.</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->cedula }}
                </span>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Email</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->email }}
                </span>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Dirección</label>
                <p class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->direccion }}
                </p>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Zona</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->zona->zona }} - {{ $cliente->zona->ciudad->ciudad }} -
                    {{ $cliente->zona->ciudad->estado->estado }}
                </span>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Teléfono Fijo</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->telefono_fijo }}
                </span>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Teléfono Celular</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->telefono_celular }}
                </span>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Fecha de Instalación</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    @php
                        // dd(gettype($cliente->fecha_instalacion));
                        // echo date(strtotime($cliente->fecha_instalacion), 'd/m/Y');
                        echo date('d-m-Y', strtotime($cliente->fecha_instalacion));
                    @endphp
                </span>
            </div>
            <div class="mt-4 mx-4">
                <label for="es_activo" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi">
                        @if ($cliente->cortado)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Cortado
                    </span>
                </label>
            </div>
            <div class="mt-4 mx-4">
                <label for="es_activo" class="form-label ml-8 sm:ml-14 mb-2">
                    <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi">
                        @if ($cliente->activo)
                            <i class="fa-solid fa-check text-xs sm:text-sm text-verde-700"></i>
                        @else
                            <i class="fa-solid fa-xmark text-xs sm:text-sm text-red-700"></i>
                        @endif
                        Activo
                    </span>
                </label>
            </div>
            <div class="mt-4 mx-4">
                <label for="" class="form-label ml-8 sm:ml-14 mb-2">Plan</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-carmesi ml-8 sm:ml-14">
                    {{ $cliente->plan->plan }}
                </span>
            </div>
        </div>



    </div>
@endsection

@section('scripts')
    @parent
@endsection
