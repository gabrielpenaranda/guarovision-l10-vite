<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'banco.index']);
        Permission::create(['name' => 'banco.create']);
        Permission::create(['name' => 'banco.edit']);
        Permission::create(['name' => 'banco.show']);
        Permission::create(['name' => 'banco.destroy']);

        Permission::create(['name' => 'ciudad.index']);
        Permission::create(['name' => 'ciudad.create']);
        Permission::create(['name' => 'ciudad.edit']);
        Permission::create(['name' => 'ciudad.show']);
        Permission::create(['name' => 'ciudad.destroy']);

        Permission::create(['name' => 'cliente.index']);
        Permission::create(['name' => 'cliente.create']);
        Permission::create(['name' => 'cliente.edit']);
        Permission::create(['name' => 'cliente.show']);
        Permission::create(['name' => 'cliente.destroy']);
        Permission::create(['name' => 'cliente.lote']);
        Permission::create(['name' => 'cliente.equipo']);
        Permission::create(['name' => 'cliente.cuenta']);

        Permission::create(['name' => 'concepto.index']);
        Permission::create(['name' => 'concepto.create']);
        Permission::create(['name' => 'concepto.edit']);
        Permission::create(['name' => 'concepto.show']);
        Permission::create(['name' => 'concepto.destroy']);
        Permission::create(['name' => 'concepto.impuesto']);

        Permission::create(['name' => 'divisa.index']);
        Permission::create(['name' => 'divisa.create']);
        Permission::create(['name' => 'divisa.edit']);
        Permission::create(['name' => 'divisa.show']);
        Permission::create(['name' => 'divisa.destroy']);
        Permission::create(['name' => 'divisa.tasa']);

        Permission::create(['name' => 'estado.index']);
        Permission::create(['name' => 'estado.create']);
        Permission::create(['name' => 'estado.edit']);
        Permission::create(['name' => 'estado.show']);
        Permission::create(['name' => 'estado.destroy']);

        Permission::create(['name' => 'equipo.index']);
        Permission::create(['name' => 'equipo.create']);
        Permission::create(['name' => 'equipo.edit']);
        Permission::create(['name' => 'equipo.show']);
        Permission::create(['name' => 'equipo.destroy']);
        Permission::create(['name' => 'equipo.lote']);

        Permission::create(['name' => 'impuesto.index']);
        Permission::create(['name' => 'impuesto.create']);
        Permission::create(['name' => 'impuesto.edit']);
        Permission::create(['name' => 'impuesto.show']);
        Permission::create(['name' => 'impuesto.destroy']);

        Permission::create(['name' => 'log.index']);
        Permission::create(['name' => 'log.show']);

        Permission::create(['name' => 'marca-equipo.index']);
        Permission::create(['name' => 'marca-equipo.create']);
        Permission::create(['name' => 'marca-equipo.edit']);
        Permission::create(['name' => 'marca-equipo.show']);
        Permission::create(['name' => 'marca-equipo.destroy']);

        Permission::create(['name' => 'modelo-equipo.index']);
        Permission::create(['name' => 'modelo-equipo.create']);
        Permission::create(['name' => 'modelo-equipo.edit']);
        Permission::create(['name' => 'modelo-equipo.show']);
        Permission::create(['name' => 'modelo-equipo.destroy']);

        Permission::create(['name' => 'movimiento-banco.index']);
        Permission::create(['name' => 'movimiento-banco.create']);
        Permission::create(['name' => 'movimiento-banco.edit']);
        Permission::create(['name' => 'movimiento-banco.show']);
        Permission::create(['name' => 'movimiento-banco.destroy']);
        Permission::create(['name' => 'movimiento-banco.carga-lote']);
        Permission::create(['name' => 'movimiento-banco.procesa-lote']);

        Permission::create(['name' => 'pago.index']);
        Permission::create(['name' => 'pago.create']);
        Permission::create(['name' => 'pago.edit']);
        Permission::create(['name' => 'pago.show']);
        Permission::create(['name' => 'pago.destroy']);
        Permission::create(['name' => 'pago.taquilla']);
        Permission::create(['name' => 'pago.web']);
        Permission::create(['name' => 'pago.concilia']);
        Permission::create(['name' => 'pago.confirma']);

        Permission::create(['name' => 'pagos-web.web']);
        Permission::create(['name' => 'pagos-web.web-show']);

        Permission::create(['name' => 'pagos-taquilla.taquilla']);
        Permission::create(['name' => 'pagos-taquilla.taquilla-show']);

        Permission::create(['name' => 'plan.index']);
        Permission::create(['name' => 'plan.create']);
        Permission::create(['name' => 'plan.edit']);
        Permission::create(['name' => 'plan.show']);
        Permission::create(['name' => 'plan.destroy']);
        Permission::create(['name' => 'plan.impuesto']);

        Permission::create(['name' => 'recibo.index']);
        Permission::create(['name' => 'recibo.create']);
        Permission::create(['name' => 'recibo.edit']);
        Permission::create(['name' => 'recibo.show']);
        Permission::create(['name' => 'recibo.destroy']);
        Permission::create(['name' => 'recibo.genera']);
        Permission::create(['name' => 'recibo.exonera']);
        Permission::create(['name' => 'recibo.recibo']);

        Permission::create(['name' => 'reporte.pago-general']);
        Permission::create(['name' => 'reporte.recibo-general']);

        Permission::create(['name' => 'taquilla.index']);
        Permission::create(['name' => 'taquilla.create']);
        Permission::create(['name' => 'taquilla.edit']);
        Permission::create(['name' => 'taquilla.show']);
        Permission::create(['name' => 'taquilla.destroy']);

        Permission::create(['name' => 'tipo-equipo.index']);
        Permission::create(['name' => 'tipo-equipo.create']);
        Permission::create(['name' => 'tipo-equipo.edit']);
        Permission::create(['name' => 'tipo-equipo.show']);
        Permission::create(['name' => 'tipo-equipo.destroy']);

        Permission::create(['name' => 'usuario.index']);
        Permission::create(['name' => 'usuario.create']);
        Permission::create(['name' => 'usuario.edit']);
        Permission::create(['name' => 'usuario.show']);
        Permission::create(['name' => 'usuario.destroy']);
        Permission::create(['name' => 'usuario.edit-password']);
        Permission::create(['name' => 'usuario.edit-permission']);
        Permission::create(['name' => 'usuario.show-deleted-user']);

        Permission::create(['name' => 'zona.index']);
        Permission::create(['name' => 'zona.create']);
        Permission::create(['name' => 'zona.edit']);
        Permission::create(['name' => 'zona.show']);
        Permission::create(['name' => 'zona.destroy']);
    }
}