@extends('layouts.app')


@section('content')
    <div class=" mx-auto py-4 max-w-3xl">
        <div class="flex align-center justify-between">
            <h4 class="titulo">Permisos</h4>
            <a class="btn btn-back btn-xs sm:btn-sm" href="{{ route('usuario.index') }}">Regresar</a>
        </div>


        @php

            $app = [
                1 => ['module' => 'Bancos', 'name' => 'banco-index', 'permission' => 'banco.index', 'description' => 'Indice'],
                2 => ['module' => 'Bancos', 'name' => 'banco-create', 'permission' => 'banco.create', 'description' => 'Crear'],
                3 => ['module' => 'Bancos', 'name' => 'banco-edit', 'permission' => 'banco.edit', 'description' => 'Editar'],
                4 => ['module' => 'Bancos', 'name' => 'banco-show', 'permission' => 'banco.show', 'description' => 'Ver'],
                5 => ['module' => 'Bancos', 'name' => 'banco-destroy', 'permission' => 'banco.destroy', 'description' => 'Eliminar'],
                6 => ['module' => 'Ciudades', 'name' => 'ciudad-index', 'permission' => 'ciudad.index', 'description' => 'Indice'],
                7 => ['module' => 'Ciudades', 'name' => 'ciudad-create', 'permission' => 'ciudad.create', 'description' => 'Crear'],
                8 => ['module' => 'Ciudades', 'name' => 'ciudad-edit', 'permission' => 'ciudad.edit', 'description' => 'Editar'],
                9 => ['module' => 'Ciudades', 'name' => 'ciudad-show', 'permission' => 'ciudad.show', 'description' => 'Ver'],
                10 => ['module' => 'Ciudades', 'name' => 'ciudad-destroy', 'permission' => 'ciudad.destroy', 'description' => 'Eliminar'],
                11 => ['module' => 'Clientes', 'name' => 'cliente-index', 'permission' => 'cliente.index', 'description' => 'Indice'],
                12 => ['module' => 'Clientes', 'name' => 'cliente-create', 'permission' => 'cliente.create', 'description' => 'Crear'],
                13 => ['module' => 'Clientes', 'name' => 'cliente-edit', 'permission' => 'cliente.edit', 'description' => 'Editar'],
                14 => ['module' => 'Clientes', 'name' => 'cliente-show', 'permission' => 'cliente.show', 'description' => 'Ver'],
                15 => ['module' => 'Clientes', 'name' => 'cliente-destroy', 'permission' => 'cliente.destroy', 'description' => 'Eliminar'],
                16 => ['module' => 'Clientes', 'name' => 'cliente-lote', 'permission' => 'cliente.lote', 'description' => 'Cargar Lote'],
                17 => ['module' => 'Clientes', 'name' => 'cliente-equipo', 'permission' => 'cliente.equipo', 'description' => 'Asignar Equipo'],
                18 => ['module' => 'Clientes', 'name' => 'cliente-cuenta', 'permission' => 'cliente.cuenta', 'description' => 'Estado de Cuenta'],
                19 => ['module' => 'Conceptos', 'name' => 'concepto-index', 'permission' => 'concepto.index', 'description' => 'Indice'],
                20 => ['module' => 'Conceptos', 'name' => 'concepto-create', 'permission' => 'concepto.create', 'description' => 'Crear'],
                21 => ['module' => 'Conceptos', 'name' => 'concepto-edit', 'permission' => 'concepto.edit', 'description' => 'Editar'],
                22 => ['module' => 'Conceptos', 'name' => 'concepto-show', 'permission' => 'plan.show', 'description' => 'Ver'],
                23 => ['module' => 'Conceptos', 'name' => 'concepto-destroy', 'permission' => 'concepto.destroy', 'description' => 'Eliminar'],
                24 => ['module' => 'Conceptos', 'name' => 'concepto-impuesto', 'permission' => 'concepto.impuesto', 'description' => 'Relacionar Impuestos'],
                25 => ['module' => 'Divisas', 'name' => 'divisa-index', 'permission' => 'divisa.index', 'description' => 'Indice'],
                26 => ['module' => 'Divisas', 'name' => 'divisa-create', 'permission' => 'divisa.create', 'description' => 'Crear'],
                27 => ['module' => 'Divisas', 'name' => 'divisa-edit', 'permission' => 'divisa.edit', 'description' => 'Editar'],
                28 => ['module' => 'Divisas', 'name' => 'divisa-show', 'permission' => 'divisa.show', 'description' => 'Ver'],
                29 => ['module' => 'Divisas', 'name' => 'divisa-destroy', 'permission' => 'divisa.destroy', 'description' => 'Eliminar'],
                30 => ['module' => 'Divisas', 'name' => 'divisa-tasa', 'permission' => 'divisa.tasa', 'description' => 'Tasa de Cambio'],
                31 => ['module' => 'Estados', 'name' => 'estado-index', 'permission' => 'estado.index', 'description' => 'Indice'],
                32 => ['module' => 'Estados', 'name' => 'estado-create', 'permission' => 'estado.create', 'description' => 'Crear'],
                33 => ['module' => 'Estados', 'name' => 'estado-edit', 'permission' => 'estado.edit', 'description' => 'Editar'],
                34 => ['module' => 'Estados', 'name' => 'estado-show', 'permission' => 'estado.show', 'description' => 'Ver'],
                35 => ['module' => 'Estados', 'name' => 'estado-destroy', 'permission' => 'estado.destroy', 'description' => 'Eliminar'],
                36 => ['module' => 'Equipos', 'name' => 'equipo-index', 'permission' => 'equipo.index', 'description' => 'Indice'],
                37 => ['module' => 'Equipos', 'name' => 'equipo-create', 'permission' => 'equipo.create', 'description' => 'Crear'],
                38 => ['module' => 'Equipos', 'name' => 'equipo-edit', 'permission' => 'equipo.edit', 'description' => 'Editar'],
                39 => ['module' => 'Equipos', 'name' => 'equipo-show', 'permission' => 'equipo.show', 'description' => 'Ver'],
                40 => ['module' => 'Equipos', 'name' => 'equipo-destroy', 'permission' => 'equipo.destroy', 'description' => 'Eliminar'],
                41 => ['module' => 'Equipos', 'name' => 'equipo-lote', 'permission' => 'equipo.lote', 'description' => 'Cargar Lote'],
                42 => ['module' => 'Impuestos', 'name' => 'impuesto-index', 'permission' => 'impuesto.index', 'description' => 'Indice'],
                43 => ['module' => 'Impuestos', 'name' => 'impuesto-create', 'permission' => 'impuesto.create', 'description' => 'Crear'],
                44 => ['module' => 'Impuestos', 'name' => 'impuesto-edit', 'permission' => 'impuesto.edit', 'description' => 'Editar'],
                45 => ['module' => 'Impuestos', 'name' => 'impuesto-show', 'permission' => 'impuesto.show', 'description' => 'Ver'],
                46 => ['module' => 'Impuestos', 'name' => 'impuesto-destroy', 'permission' => 'impuesto.destroy', 'description' => 'Eliminar'],
                47 => ['module' => 'Logs', 'name' => 'log-index', 'permission' => 'log.index', 'description' => 'Indice'],
                48 => ['module' => 'Logs', 'name' => 'log-show', 'permission' => 'log.show', 'description' => 'Ver'],
                49 => ['module' => 'Marca de Equipo', 'name' => 'marca-equipo-index', 'permission' => 'marca-equipo.index', 'description' => 'Indice'],
                50 => ['module' => 'Marca de Equipo', 'name' => 'marca-equipo-create', 'permission' => 'marca-equipo.create', 'description' => 'Crear'],
                51 => ['module' => 'Marca de Equipo', 'name' => 'marca-equipo-edit', 'permission' => 'marca-equipo.edit', 'description' => 'Editar'],
                52 => ['module' => 'Marca de Equipo', 'name' => 'marca-equipo-show', 'permission' => 'marca-equipo.show', 'description' => 'Ver'],
                53 => ['module' => 'Marca de Equipo', 'name' => 'marca-equipo-destroy', 'permission' => 'marca-equipo.destroy', 'description' => 'Eliminar'],
                54 => ['module' => 'Modelo de Equipo', 'name' => 'modelo-equipo-index', 'permission' => 'modelo-equipo.index', 'description' => 'Indice'],
                55 => ['module' => 'Modelo de Equipo', 'name' => 'modelo-equipo-create', 'permission' => 'modelo-equipo.create', 'description' => 'Crear'],
                56 => ['module' => 'Modelo de Equipo', 'name' => 'modelo-equipo-edit', 'permission' => 'modelo-equipo.edit', 'description' => 'Editar'],
                57 => ['module' => 'Modelo de Equipo', 'name' => 'modelo-equipo-show', 'permission' => 'modelo-equipo.show', 'description' => 'Ver'],
                58 => ['module' => 'Modelo de Equipo', 'name' => 'modelo-equipo-destroy', 'permission' => 'modelo-equipo.destroy', 'description' => 'Eliminar'],
                59 => ['module' => 'Movimientos Bancarios', 'name' => 'movimiento-banco-index', 'permission' => 'movimiento-banco.index', 'description' => 'Indice'],
                60 => ['module' => 'Movimientos Bancarios', 'name' => 'movimiento-banco-carga-lote', 'permission' => 'movimiento-banco.carga-lote', 'description' => 'Cargar Lote'],
                61 => ['module' => 'Pagos', 'name' => 'pago-index', 'permission' => 'pago.index', 'description' => 'Indice'],
                62 => ['module' => 'Pagos', 'name' => 'pago-create', 'permission' => 'pago.create', 'description' => 'Crear'],
                63 => ['module' => 'Pagos', 'name' => 'pago-edit', 'permission' => 'pago.edit', 'description' => 'Editar'],
                64 => ['module' => 'Pagos', 'name' => 'pago-show', 'permission' => 'pago.show', 'description' => 'Ver'],
                65 => ['module' => 'Pagos', 'name' => 'pago-destroy', 'permission' => 'pago.destroy', 'description' => 'Eliminar'],
                66 => ['module' => 'Pagos', 'name' => 'pago-taquilla', 'permission' => 'pago.taquilla', 'description' => 'Pagos por Taquilla'],
                67 => ['module' => 'Pagos', 'name' => 'pago-web', 'permission' => 'pago.web', 'description' => 'Pagos Web'],
                68 => ['module' => 'Pagos', 'name' => 'pago-concilia', 'permission' => 'pago.concilia', 'description' => 'Conciliación'],
                69 => ['module' => 'Pagos', 'name' => 'pago-confirma', 'permission' => 'pago.confirma', 'description' => 'Confirmación'],
                70 => ['module' => 'Pagos Web', 'name' => 'pagos-web-web', 'permission' => 'pagos-web.web', 'description' => 'Indice'],
                71 => ['module' => 'Pagos Web', 'name' => 'pagos-web-web-show', 'permission' => 'pagos-web.web-show', 'description' => 'Ver'],
                72 => ['module' => 'Pagos Taquilla', 'name' => 'pagos-taquilla-taquilla', 'permission' => 'pagos-taquilla.taquilla', 'description' => 'Indice'],
                73 => ['module' => 'Pagos Taquilla', 'name' => 'pagos-taquilla-taquilla-show', 'permission' => 'pagos-taquilla.taquilla-show', 'description' => 'Ver'],
                74 => ['module' => 'Planes', 'name' => 'plan-index', 'permission' => 'plan.index', 'description' => 'Indice'],
                75 => ['module' => 'Planes', 'name' => 'plan-create', 'permission' => 'plan.create', 'description' => 'Crear'],
                76 => ['module' => 'Planes', 'name' => 'plan-edit', 'permission' => 'plan.edit', 'description' => 'Editar'],
                77 => ['module' => 'Planes', 'name' => 'plan-show', 'permission' => 'plan.show', 'description' => 'Ver'],
                78 => ['module' => 'Planes', 'name' => 'plan-destroy', 'permission' => 'plan.destroy', 'description' => 'Eliminar'],
                79 => ['module' => 'Planes', 'name' => 'plan-impuesto', 'permission' => 'plan.impuesto', 'description' => 'Relacionar Impuestos'],
                80 => ['module' => 'Consumos', 'name' => 'recibo-index', 'permission' => 'recibo.index', 'description' => 'Indice'],
                81 => ['module' => 'Consumos', 'name' => 'recibo-create', 'permission' => 'recibo.create', 'description' => 'Crear'],
                82 => ['module' => 'Consumos', 'name' => 'recibo-edit', 'permission' => 'recibo.edit', 'description' => 'Editar'],
                83 => ['module' => 'Consumos', 'name' => 'recibo-show', 'permission' => 'recibo.show', 'description' => 'Ver'],
                84 => ['module' => 'Consumos', 'name' => 'recibo-destroy', 'permission' => 'recibo.destroy', 'description' => 'Eliminar'],
                85 => ['module' => 'Consumos', 'name' => 'recibo-genera', 'permission' => 'recibo.genera', 'description' => 'Generar Comprobantes'],
                86 => ['module' => 'Consumos', 'name' => 'recibo-exonera', 'permission' => 'recibo.exonera', 'description' => 'Exonerar Consumos'],
                87 => ['module' => 'Consumos', 'name' => 'recibo-recibo', 'permission' => 'recibo.recibo', 'description' => 'Registrar Consumos'],
                88 => ['module' => 'Reportes', 'name' => 'reporte-pago-general', 'permission' => 'reporte.pago-general', 'description' => 'Reporte de Pagos por Fecha'],
                89 => ['module' => 'Reportes', 'name' => 'reporte-recibo-general', 'permission' => 'reporte.recibo-general', 'description' => 'Reporte de Consumos por Fecha '],
                90 => ['module' => 'Taquillas', 'name' => 'taquilla-index', 'permission' => 'taquilla.index', 'description' => 'Indice'],
                91 => ['module' => 'Taquillas', 'name' => 'taquilla-create', 'permission' => 'taquilla.create', 'description' => 'Crear'],
                92 => ['module' => 'Taquillas', 'name' => 'taquilla-edit', 'permission' => 'taquilla.edit', 'description' => 'Editar'],
                93 => ['module' => 'Taquillas', 'name' => 'taquilla-show', 'permission' => 'taquilla.show', 'description' => 'Ver'],
                94 => ['module' => 'Taquillas', 'name' => 'taquilla-destroy', 'permission' => 'taquilla.destroy', 'description' => 'Eliminar'],
                95 => ['module' => 'Tipo de Equipo', 'name' => 'tipo-equipo-index', 'permission' => 'tipo-equipo.index', 'description' => 'Indice'],
                96 => ['module' => 'Tipo de Equipo', 'name' => 'tipo-equipo-create', 'permission' => 'tipo-equipo.create', 'description' => 'Crear'],
                97 => ['module' => 'Tipo de Equipo', 'name' => 'tipo-equipo-edit', 'permission' => 'tipo-equipo.edit', 'description' => 'Editar'],
                98 => ['module' => 'Tipo de Equipo', 'name' => 'tipo-equipo-show', 'permission' => 'tipo-equipo.show', 'description' => 'Ver'],
                99 => ['module' => 'Tipo de Equipo', 'name' => 'tipo-equipo-destroy', 'permission' => 'tipo-equipo.destroy', 'description' => 'Eliminar'],
                100 => ['module' => 'Usuarios', 'name' => 'usuario-index', 'permission' => 'usuario.index', 'description' => 'Indice'],
                101 => ['module' => 'Usuarios', 'name' => 'usuario-create', 'permission' => 'usuario.create', 'description' => 'Crear'],
                102 => ['module' => 'Usuarios', 'name' => 'usuario-edit', 'permission' => 'usuario.edit', 'description' => 'Editar'],
                103 => ['module' => 'Usuarios', 'name' => 'usuario-show', 'permission' => 'usuario.show', 'description' => 'Ver'],
                104 => ['module' => 'Usuarios', 'name' => 'usuario-destroy', 'permission' => 'usuario.destroy', 'description' => 'Eliminar'],
                105 => ['module' => 'Usuarios', 'name' => 'usuario-edit-password', 'permission' => 'usuario.edit-password', 'description' => 'Cambiar Contraseña'],
                106 => ['module' => 'Usuarios', 'name' => 'usuario-edit-permission', 'permission' => 'usuario.edit-permission', 'description' => 'Editar Permisos'],
                107 => ['module' => 'Usuarios', 'name' => 'usuario-show-deleted-user', 'permission' => 'usuario.show-deleted-user', 'description' => 'Ver Usuarios Eliminados'],
                108 => ['module' => 'Zonas', 'name' => 'zona-index', 'permission' => 'zona.index', 'description' => 'Indice'],
                109 => ['module' => 'Zonas', 'name' => 'zona-create', 'permission' => 'zona.create', 'description' => 'Crear'],
                110 => ['module' => 'Zonas', 'name' => 'zona-edit', 'permission' => 'zona.edit', 'description' => 'Editar'],
                111 => ['module' => 'Zonas', 'name' => 'zona-show', 'permission' => 'zona.show', 'description' => 'Ver'],
                112 => ['module' => 'Zonas', 'name' => 'zona-destroy', 'permission' => 'zona.destroy', 'description' => 'Eliminar'],
            ];

            $module = '';

        @endphp

        <p class="mt-2 pl-4 text-sm sm:text-lg">
            Usuario:
            <span class="pl-2 font-bold">{{ $user->name }}</span>
        </p>

        <div class="mt-4 mx-4">
            <span class="text-xs sm:text-sm">
                Para tener acceso a cualquier funcionalidad (Ej. "Crear", "Ver", etc.) debe estár chequeado el permiso
                "Indice".
            </span>
        </div>

        <form action="{{ route('usuario.update-permission', ['user' => $user->id]) }}" method="POST">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            @for ($i = 1; $i <= 112; $i++)
                @if ($module != $app[$i]['module'])
                    @php
                        $module = $app[$i]['module'];
                    @endphp
                    <div class="mt-4 mx-8">
                        <span class="text-sm sm:text-base font-semibold">{{ $module }}</span>
                    </div>
                @endif
                <div class="mx-12">
                    <label for="{{ $app[$i]['name'] }}" class="form-label">
                        <input type="checkbox" name="{{ $app[$i]['name'] }}" class="form-control" value="permission"
                            {{ $user->hasPermissionTo($app[$i]['permission']) ? 'checked' : '' }} />
                        {{ $app[$i]['description'] }}
                    </label>
                </div>
            @endfor

            <div class="mt-6 mx-4">
                @can('usuario.edit-permission')
                    <button type="submit" class="btn btn-save btn-xs sm:btn-sm">Actualizar permisos</button>
                @endcan
            </div>
        </form>
    </div>
@endsection

@section('javascripts')
    @parent
@endsection
