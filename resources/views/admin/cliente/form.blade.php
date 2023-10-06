@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($cliente->exists)
                <h4 class="titulo">Editar Cliente</h4>
                <form action="{{ route('cliente.update', ['cliente' => $cliente->id]) }}" enctype="multipart/form-data"
                    method="POST">
                    @method('PUT')
                @else
                    <h4 class="titulo">Crear Cliente</h4>
                    <form action="{{ route('cliente.store') }}" enctype="multipart/form-data" method="POST">
            @endif

            @csrf

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('cliente.index') }}">Regresar</a>
        </div>

        <div class="mt4 mx-4">
            @if ($cliente->exists && $cliente->foto != '')
                <img src="{{ asset($cliente->foto) }}" alt="{{ $cliente->foto }}" width="150px">
            @endif
        </div>

        <div class="mt-4 mx-4">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" class="form-control w-full" id="apellidos"
                value="{{ $cliente->exists ? $cliente->apellidos : old('apellidos') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" class="form-control w-full" id="nombres"
                value="{{ $cliente->exists ? $cliente->nombres : old('apelnombreslnombresidos') }}">
        </div>

        <div class="mt-4 mx-4">
            {{-- @if ($cliente->exists)
                <label for="" class="form-label mb-2">C.I.</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit">
                    {{ $cliente->cedula }}
                </span>
            @else
            @endif --}}
            <label for="cedula" class="form-label">C.I.</label>
            <input type="text" name="cedula" class="form-control w-full" id="cedula"
                value="{{ $cliente->exists ? $cliente->cedula : old('cedula') }}">
        </div>

        <div class="mt-4 mx-4">
            {{-- @if ($cliente->exists)
                <label for="" class="form-label mb-2">Email</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit">
                    {{ $cliente->email }}
                </span>
            @else
            @endif --}}
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control w-full" id="email"
                value="{{ $cliente->exists ? $cliente->email : old('email') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control w-full" id="direccion"
                value="{{ $cliente->exists ? $cliente->direccion : old('direccion') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="zona_id" class="form-label">Zona</label>
            <select name="zona_id" class="form-control w-full">
                @foreach ($zonas as $zona)
                    @if ($cliente->exists)
                        @if ($cliente->zona_id == $zona->id)
                            <option value="{{ $zona->id }}" selected>
                            @else
                            <option value="{{ $zona->id }}">
                        @endif
                        {{ $zona->zona }} - {{ $zona->ciudad->ciudad }} - {{ $zona->ciudad->estado->estado }}
                    @else
                        <option value="{{ $zona->id }}">
                            {{ $zona->zona }} - {{ $zona->ciudad->ciudad }} - {{ $zona->ciudad->estado->estado }}
                        </option>
                    @endif
                @endforeach
                </option>
            </select>
        </div>


        <div class="mt-4 mx-4">
            <label for="olt" class="form-label">OLT</label>
            <input type="text" name="olt" class="form-control w-full" id="olt"
                value="{{ $cliente->exists ? $cliente->olt : old('olt') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="tarjeta" class="form-label">Tarjeta</label>
            <input type="text" name="tarjeta" class="form-control w-full" id="tarjeta"
                value="{{ $cliente->exists ? $cliente->tarjeta : old('tarjeta') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="puerto" class="form-label">Puerto</label>
            <input type="text" name="puerto" class="form-control w-full" id="puerto"
                value="{{ $cliente->exists ? $cliente->puerto : old('puerto') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="telefono_fijo" class="form-label">Teléfono Fijo</label>
            <input type="text" name="telefono_fijo" class="form-control w-full" id="telefono_fijo"
                value="{{ $cliente->exists ? $cliente->telefono_fijo : old('telefono_fijo') }}">
        </div>

        <div class="mt-4 mx-4">
            {{-- @if ($cliente->exists)
                <label for="" class="form-label mb-2">Teléfono Celular</label>
                <span class="text-xs sm:text-base md:text-lg font-semibold hl-edit">
                    {{ $cliente->telefono_celular }}
                </span>
            @else
            @endif --}}
            <label for="telefono_celular" class="form-label">Teléfono Celular</label>
            <input type="text" name="telefono_celular" class="form-control w-full" id="telefono_celular"
                value="{{ $cliente->exists ? $cliente->telefono_celular : old('telefono_celular') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control w-full" id="foto" accept="image/*"
                value="{{ $cliente->exists ? $cliente->foto : old('foto') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="imagen_cedula" class="form-label">Cédula</label>
            <input type="file" name="imagen_cedula" class="form-control w-full" id="imagen_cedula"
                value="{{ $cliente->exists ? $cliente->imagen_cedula : old('imagen_cedula') }}">
        </div>

        <div class="mt-4 mx-4">
            <label for="fecha_instalacion" class="form-label">Fecha de instalación</label>
            <input type="date" name="fecha_instalacion" class="form-control w-full" id="fecha_instalacion"
                value="{{ $cliente->exists ? $cliente->fecha_instalacion : old('fecha_instalacion') }}">
        </div>

        {{-- <div class="mt-4 mx-4">
            <label for="cortado" class="form-label">
                <input type="checkbox" name="cortado" class="form-control" value="cortado"
                    {{ $cliente->cortado ? 'checked' : '' }} />
                Cortado
            </label>
        </div> --}}

        <div class="mt-4 mx-4">
            <label for="activo" class="form-label">
                <input type="checkbox" name="activo" class="form-control" value="activo"
                    {{ $cliente->activo ? 'checked' : '' }} />
                Activo
            </label>
        </div>

        <div class="mt-4 mx-4">
            <label for="plan_id" class="form-label">Plan</label>
            <select name="plan_id" class="form-control w-full">
                @foreach ($planes as $plan)
                    @if ($cliente->exists)
                        @if ($cliente->plan_id == $plan->id)
                            <option value="{{ $plan->id }}" selected>
                            @else
                            <option value="{{ $plan->id }}">
                        @endif
                        {{ $plan->plan }}
                        </option>
                    @else
                        <option value="{{ $plan->id }}">
                            {{ $plan->plan }}
                        </option>
                    @endif
                @endforeach

            </select>
        </div>

        <div class="mt-6 ml-4">
            @if ($cliente->exists)
                @can('cliente.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('cliente.create')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Crear</button>
                @endcan
            @endif
        </div>

        <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
