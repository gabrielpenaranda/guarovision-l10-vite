@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">

            @if ($user->exists)
                <h4 class="titulo">Editar Usuario</h4>
                <form action="{{ route('usuario.update', ['user' => $user->id]) }}" method="POST">
                    {{ method_field('PUT') }}
                @else
                    <h4 class="titulo">Crear Usuario</h4>
                    <form action="{{ route('usuario.store') }}" method="POST">
            @endif

            {{ csrf_field() }}

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('usuario.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="name" class="form-label">Nombre(s) y Apellido(s)</label>
            <input type="text" name="name" class="form-control w-full" id="name"
                value="{{ $user->exists ? $user->name : old('name') }}">
        </div>

        <div class="mt-4 mx-4">
            @if ($user->exists)
                <label for="email" class="form-label">Email</label>
                <span class="hl-edit">{{ $user->email }}</span>
            @else
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control w-full" id="email"
                    value="{{ $user->exists ? $user->email : old('email') }}">
            @endif

        </div>

        <div class="mt-4 mx-4">
            @if ($user->exists)
                <label for="identification" class="form-label">Número de C.I.</label>
                <span class="hl-edit">
                    {{ $user->identification }}
                </span>
            @else
                <label for="identification" class="form-label">Número de C.I.</label>
                <input type="text" name="identification" class="form-control w-full" id="identification"
                    value="{{ $user->exists ? $user->identification : old('identification') }}">
            @endif

        </div>


        @if (!$user->exists)
            <div class="mt-4 mx-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control w-full"
                    value="{{ $user->exists ? $user->password : old('password') }}" />
            </div>

            <div class="mt-4 mx-4">
                <label for="password-confirmation" class="form-label">Confirmar contraseña</label>
                <input type="password" name="password-confirmation" class="form-control w-full"
                    value="{{ $user->exists ? $user->password - confirmation : old('password-confirmation') }}" />
            </div>
        @endif

        <div class="mt-6 ml-4">
            @if ($user->exists)
                @can('usuario.edit')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            @else
                @can('usuario.create')
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
