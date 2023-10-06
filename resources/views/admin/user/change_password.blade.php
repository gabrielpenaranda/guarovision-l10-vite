@extends('layouts.app')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <div class="container mx-auto py-4 max-w-3xl">
        <div class="flex pb-2 items-center justify-between">
            <h4 class="titulo">Cambiar Contraseña</h4>

            <a class="btn btn-back btn-xs sm:btn-sm mr-4" href="{{ route('usuario.index') }}">Regresar</a>
        </div>

        <div class="mt-4 mx-4">
            <label for="name" class="form-label">Nombre(s) y Apellido(s)</label>
            <span class="hl-change-password">{{ $user->name }}</span>
        </div>

        <div class="mt-4 mx-4">
            <label for="email" class="form-label">Email</label>
            <span class="hl-change-password">{{ $user->email }}</span>

        </div>

        <div class="mt-4 mx-4">
            <label for="identification" class="form-label">Número de C.I.</label>
            <span class="hl-change-password">{{ $user->identification }}</span>
        </div>

        <form action="{{ route('usuario.update-password', ['user' => $user->id]) }}" method="POST">
            @method('PUT')
            @csrf

            <div class="mt-4 mx-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control w-full" value="{{ old('password') }}" />
            </div>

            <div class="mt-4 mx-4">
                <label for="password-confirmation" class="form-label">Confirmar contraseña</label>
                <input type="password" name="password-confirmation" class="form-control w-full"
                    value="{{ old('password-confirmation') }}" />
            </div>

            <div class="mt-6 ml-4">
                @can('usuario.edit-password')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar</button>
                @endcan
            </div>

            <br>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
@endsection
