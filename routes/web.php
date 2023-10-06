<?php

use App\Http\Controllers\BancoController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CiudadController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ConceptoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\DivisaController;
use App\Http\Controllers\ImpuestoController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MarcaEquipoController;
use App\Http\Controllers\ModeloEquipoController;
use App\Http\Controllers\MovimientoBancoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\PagoWebController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\TaquillaController;
use App\Http\Controllers\TipoEquipoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZonaController;

// Controlador para exportar lista de clientes
use App\Http\Controllers\ExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ruta para exportar lista de clientes
Route::get('/exporta-clientes', [ExportController::class, 'exporta_clientes']);

Route::get('/', [PagoWebController::class, 'index'])->name('pago-web.index');
Route::get('/', [PagoWebController::class, 'index'])->name('pago-web.index');
Route::post('/', [PagoWebController::class, 'carga_datos'])->name('pago-web.carga_datos');
Route::post('/cuenta/{cliente}', [PagoWebController::class, 'cuenta'])->name('pago-web.cuenta');
Route::post('/pago/{cliente}', [PagoWebController::class, 'procesa_pago'])->name('pago-web.procesa-pago');
Route::get('/gracias', [PagoWebController::class, 'gracias'])->name('pago-web.gracias');

Route::get('/salir', [LogoutController::class, 'salir'])->name('salir');

Route::get('/admin', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->prefix('admin')->group(function () {

    Route::prefix('banco')->group(function () {
        Route::get('/', [BancoController::class, 'index'])->name('banco.index')
            ->middleware('permission:banco.index');
        Route::get('/create', [BancoController::class, 'create'])->name('banco.create')
            ->middleware('permission:banco.create');
        Route::post('/store', [BancoController::class, 'store'])->name('banco.store')
            ->middleware('permission:banco.create');
        Route::get('/show/{banco}', [BancoController::class, 'show'])->name('banco.show')
            ->middleware('permission:banco.show');
        Route::get('/show-destroy/{banco}', [BancoController::class, 'show_destroy'])->name('banco.show-destroy')
            ->middleware('permission:banco.destroy');
        Route::delete('/destroy/{banco}', [BancoController::class, 'destroy'])->name('banco.destroy')
            ->middleware('permission:banco.destroy');
        Route::get('/edit/{banco}', [BancoController::class, 'edit'])->name('banco.edit')
            ->middleware('permission:banco.edit');
        Route::put('/update/{banco}', [BancoController::class, 'update'])->name('banco.update')
            ->middleware('permission:banco.edit');
    });

    Route::prefix('ciudad')->group(function () {
        Route::get('/', [CiudadController::class, 'index'])->name('ciudad.index')
            ->middleware('permission:ciudad.index');
        Route::get('/create', [CiudadController::class, 'create'])->name('ciudad.create')
            ->middleware('permission:ciudad.create');
        Route::post('/store', [CiudadController::class, 'store'])->name('ciudad.store')
            ->middleware('permission:ciudad.create');
        Route::get('/show/{ciudad}', [CiudadController::class, 'show'])->name('ciudad.show')
            ->middleware('permission:ciudad.show');
        Route::get('/show-destroy/{ciudad}', [CiudadController::class, 'show_destroy'])->name('ciudad.show-destroy')
            ->middleware('permission:ciudad.destroy');
        Route::delete('/destroy/{ciudad}', [CiudadController::class, 'destroy'])->name('ciudad.destroy')
            ->middleware('permission:ciudad.destroy');
        Route::get('/edit/{ciudad}', [CiudadController::class, 'edit'])->name('ciudad.edit')
            ->middleware('permission:ciudad.edit');
        Route::put('/update/{ciudad}', [CiudadController::class, 'update'])->name('ciudad.update')
            ->middleware('permission:ciudad.edit');
    });

    Route::prefix('cliente')->group(function () {
        Route::get('/', [ClienteController::class, 'index'])->name('cliente.index')
            ->middleware('permission:cliente.index');
        Route::get('/create', [ClienteController::class, 'create'])->name('cliente.create')
            ->middleware('permission:cliente.create');
        Route::post('/store', [ClienteController::class, 'store'])->name('cliente.store')
            ->middleware('permission:cliente.create');
        Route::get('/show/{cliente}', [ClienteController::class, 'show'])->name('cliente.show')
            ->middleware('permission:cliente.show');
        Route::get('/show-destroy/{cliente}', [ClienteController::class, 'show_destroy'])->name('cliente.show-destroy')
            ->middleware('permission:cliente.destroy');
        Route::delete('/destroy/{cliente}', [ClienteController::class, 'destroy'])->name('cliente.destroy')
            ->middleware('permission:cliente.destroy');
        Route::get('/edit/{cliente}', [ClienteController::class, 'edit'])->name('cliente.edit')
            ->middleware('permission:cliente.edit');
        Route::put('/update/{cliente}', [ClienteController::class, 'update'])->name('cliente.update')
            ->middleware('permission:cliente.edit');
        // Cargar Lote
        Route::get('/carga-lote', [ClienteController::class, 'carga_lote'])->name('cliente.carga-lote')
            ->middleware('permission:cliente.lote');
        Route::post('/procesa-lote', [ClienteController::class, 'procesa_lote'])->name('cliente.procesa-lote')
            ->middleware('permission:cliente.lote');
        // Asigna Equipo
        Route::get('/equipo/{cliente}', [ClienteController::class, 'equipo'])->name('cliente.equipo')
            ->middleware('permission:cliente.equipo');
        Route::put('/equipo/{cliente}', [ClienteController::class, 'store_equipo'])->name('cliente.store_equipo')
            ->middleware('permission:cliente.equipo');
        // Estado de Cuenta
        Route::get('/cuenta/{cliente}', [ClienteController::class, 'cuenta'])->name('cliente.cuenta')
            ->middleware('permission:cliente.cuenta');
    });

    Route::prefix('concepto')->group(function () {
        Route::get('/', [ConceptoController::class, 'index'])->name('concepto.index')
            ->middleware('permission:concepto.index');
        Route::get('/create', [ConceptoController::class, 'create'])->name('concepto.create')
            ->middleware('permission:concepto.create');
        Route::post('/store', [ConceptoController::class, 'store'])->name('concepto.store')
            ->middleware('permission:concepto.create');
        Route::get('/show/{concepto}', [ConceptoController::class, 'show'])->name('concepto.show')
            ->middleware('permission:concepto.show');
        Route::get('/show-destroy/{concepto}', [ConceptoController::class, 'show_destroy'])->name('concepto.show-destroy')
            ->middleware('permission:concepto.destroy');
        Route::delete('/destroy/{concepto}', [ConceptoController::class, 'destroy'])->name('concepto.destroy')
            ->middleware('permission:concepto.destroy');
        Route::get('/edit/{concepto}', [ConceptoController::class, 'edit'])->name('concepto.edit')
            ->middleware('permission:concepto.edit');
        Route::put('/update/{concepto}', [ConceptoController::class, 'update'])->name('concepto.update')
            ->middleware('permission:concepto.edit');
        // Asigna Impuesto
        Route::get('/concepto-impuesto/{concepto}', [ConceptoController::class, 'impuesto'])->name('concepto.impuesto')
            ->middleware('permission:concepto.impuesto');
        Route::post('/concepto-impuesto/{concepto}', [ConceptoController::class, 'store_impuesto'])->name('concepto.store_impuesto')
            ->middleware('permission:concepto.impuesto');
    });

    Route::prefix('divisa')->group(function () {
        Route::get('/', [DivisaController::class, 'index'])->name('divisa.index')
            ->middleware('permission:divisa.index');
        Route::get('/create', [DivisaController::class, 'create'])->name('divisa.create')
            ->middleware('permission:divisa.create');
        Route::post('/store', [DivisaController::class, 'store'])->name('divisa.store')
            ->middleware('permission:divisa.create');
        Route::get('/show/{divisa}', [DivisaController::class, 'show'])->name('divisa.show')
            ->middleware('permission:divisa.show');
        Route::get('/show-destroy/{divisa}', [DivisaController::class, 'show_destroy'])->name('divisa.show-destroy')
            ->middleware('permission:divisa.destroy');
        Route::delete('/destroy/{divisa}', [DivisaController::class, 'destroy'])->name('divisa.destroy')
            ->middleware('permission:divisa.destroy');
        Route::get('/edit/{divisa}', [DivisaController::class, 'edit'])->name('divisa.edit')
            ->middleware('permission:divisa.edit');
        Route::put('/update/{divisa}', [DivisaController::class, 'update'])->name('divisa.update')
            ->middleware('permission:divisa.edit');
        // Tasa de cambio
        Route::get('/tasa/{divisa}', [DivisaController::class, 'edit_tasa'])->name('divisa.tasa')
            ->middleware('permission:divisa.tasa');
        Route::put('/update_tasa/{divisa}', [DivisaController::class, 'update_tasa'])->name('divisa.update_tasa')
            ->middleware('permission:divisa.tasa');
    });

    Route::prefix('equipo')->group(function () {
        Route::get('/', [EquipoController::class, 'index'])->name('equipo.index')
            ->middleware('permission:equipo.index');
        Route::get('/create', [EquipoController::class, 'create'])->name('equipo.create')
            ->middleware('permission:equipo.create');
        Route::post('/store', [EquipoController::class, 'store'])->name('equipo.store')
            ->middleware('permission:equipo.create');
        Route::get('/show/{equipo}', [EquipoController::class, 'show'])->name('equipo.show')
            ->middleware('permission:equipo.show');
        Route::get('/show-destroy/{equipo}', [EquipoController::class, 'show_destroy'])->name('equipo.show-destroy')
            ->middleware('permission:equipo.destroy');
        Route::delete('/destroy/{equipo}', [EquipoController::class, 'destroy'])->name('equipo.destroy')
            ->middleware('permission:equipo.destroy');
        Route::get('/edit/{equipo}', [EquipoController::class, 'edit'])->name('equipo.edit')
            ->middleware('permission:equipo.edit');
        Route::put('/update/{equipo}', [EquipoController::class, 'update'])->name('equipo.update')
            ->middleware('permission:equipo.edit');
        // Cargar Lote
        Route::get('/carga-lote', [EquipoController::class, 'carga_lote'])->name('equipo.carga-lote')
            ->middleware('permission:cliente.lote');
        Route::post('/procesa-lote', [EquipoController::class, 'procesa_lote'])->name('equipo.procesa-lote')
            ->middleware('permission:cliente.lote');
    });

    Route::prefix('estado')->group(function () {
        Route::get('/', [EstadoController::class, 'index'])->name('estado.index')
            ->middleware('permission:estado.index');
        Route::get('/create', [EstadoController::class, 'create'])->name('estado.create')
            ->middleware('permission:estado.create');
        Route::post('/store', [EstadoController::class, 'store'])->name('estado.store')
            ->middleware('permission:estado.create');
        Route::get('/show/{estado}', [EstadoController::class, 'show'])->name('estado.show')
            ->middleware('permission:estado.show');
        Route::get('/show-destroy/{estado}', [EstadoController::class, 'show_destroy'])->name('estado.show-destroy')
            ->middleware('permission:estado.destroy');
        Route::delete('/destroy/{estado}', [EstadoController::class, 'destroy'])->name('estado.destroy')
            ->middleware('permission:estado.destroy');
        Route::get('/edit/{estado}', [EstadoController::class, 'edit'])->name('estado.edit')
            ->middleware('permission:estado.edit');
        Route::put('/update/{estado}', [EstadoController::class, 'update'])->name('estado.update')
            ->middleware('permission:estado.edit');
    });


    Route::prefix('impuesto')->group(function () {
        Route::get('/', [ImpuestoController::class, 'index'])->name('impuesto.index')
            ->middleware('permission:impuesto.index');
        Route::get('/create', [ImpuestoController::class, 'create'])->name('impuesto.create')
            ->middleware('permission:impuesto.create');
        Route::post('/store', [ImpuestoController::class, 'store'])->name('impuesto.store')
            ->middleware('permission:impuesto.create');
        Route::get('/show/{impuesto}', [ImpuestoController::class, 'show'])->name('impuesto.show')
            ->middleware('permission:impuesto.show');
        Route::get('/show-destroy/{impuesto}', [ImpuestoController::class, 'show_destroy'])->name('impuesto.show-destroy')
            ->middleware('permission:impuesto.destroy');
        Route::delete('/destroy/{impuesto}', [ImpuestoController::class, 'destroy'])->name('impuesto.destroy')
            ->middleware('permission:impuesto.destroy');
        Route::get('/edit/{impuesto}', [ImpuestoController::class, 'edit'])->name('impuesto.edit')
            ->middleware('permission:impuesto.edit');
        Route::put('/update/{impuesto}', [ImpuestoController::class, 'update'])->name('impuesto.update')
            ->middleware('permission:impuesto.edit');
    });

    Route::prefix('log')->group(function () {
        Route::get('/', [LogController::class, 'index'])->name('log.index')
            ->middleware('permission:log.index');
        Route::get('/show/{log}', [LogController::class, 'show'])->name('log.show')
            ->middleware('permission:log.show');
    });

    Route::prefix('marca-equipo')->group(function () {
        Route::get('/', [MarcaEquipoController::class, 'index'])->name('marca-equipo.index')
            ->middleware('permission:marca-equipo.index');
        Route::get('/create', [MarcaEquipoController::class, 'create'])->name('marca-equipo.create')
            ->middleware('permission:marca-equipo.create');
        Route::post('/store', [MarcaEquipoController::class, 'store'])->name('marca-equipo.store')
            ->middleware('permission:marca-equipo.create');
        Route::get('/show/{marca_equipo}', [MarcaEquipoController::class, 'show'])->name('marca-equipo.show')
            ->middleware('permission:marca-equipo.show');
        Route::get('/show-destroy/{marca_equipo}', [MarcaEquipoController::class, 'show_destroy'])->name('marca-equipo.show-destroy')
            ->middleware('permission:marca-equipo.destroy');
        Route::delete('/destroy/{marca_equipo}', [MarcaEquipoController::class, 'destroy'])->name('marca-equipo.destroy')
            ->middleware('permission:marca-equipo.destroy');
        Route::get('/edit/{marca_equipo}', [MarcaEquipoController::class, 'edit'])->name('marca-equipo.edit')
            ->middleware('permission:marca-equipo.edit');
        Route::put('/update/{marca_equipo}', [MarcaEquipoController::class, 'update'])->name('marca-equipo.update')
            ->middleware('permission:marca-equipo.edit');
    });

    Route::prefix('modelo-equipo')->group(function () {
        Route::get('/', [ModeloEquipoController::class, 'index'])->name('modelo-equipo.index')
            ->middleware('permission:modelo-equipo.index');
        Route::get('/create', [ModeloEquipoController::class, 'create'])->name('modelo-equipo.create')
            ->middleware('permission:modelo-equipo.create');
        Route::post('/store', [ModeloEquipoController::class, 'store'])->name('modelo-equipo.store')
            ->middleware('permission:modelo-equipo.create');
        Route::get('/show/{modelo_equipo}', [ModeloEquipoController::class, 'show'])->name('modelo-equipo.show')
            ->middleware('permission:modelo-equipo.show');
        Route::get('/show-destroy/{modelo_equipo}', [ModeloEquipoController::class, 'show_destroy'])->name('modelo-equipo.show-destroy')
            ->middleware('permission:modelo-equipo.destroy');
        Route::delete('/destroy/{modelo_equipo}', [ModeloEquipoController::class, 'destroy'])->name('modelo-equipo.destroy')
            ->middleware('permission:modelo-equipo.destroy');
        Route::get('/edit/{modelo_equipo}', [ModeloEquipoController::class, 'edit'])->name('modelo-equipo.edit')
            ->middleware('permission:modelo-equipo.edit');
        Route::put('/update/{modelo_equipo}', [ModeloEquipoController::class, 'update'])->name('modelo-equipo.update')
            ->middleware('permission:modelo-equipo.edit');
    });

    Route::prefix('movimiento-banco')->group(function () {
        Route::get('/', [MovimientoBancoController::class, 'index'])->name('movimiento-banco.index')
            ->middleware('permission:movimiento-banco.index');
        Route::get('/create', [MovimientoBancoController::class, 'create'])->name('movimiento-banco.create')
            ->middleware('permission:movimiento-banco.create');
        Route::post('/store', [MovimientoBancoController::class, 'store'])->name('movimiento-banco.store')
            ->middleware('permission:movimiento-banco.create');
        Route::get('/show/{movimiento_banco}', [MovimientoBancoController::class, 'show'])->name('movimiento-banco.show')
            ->middleware('permission:movimiento-banco.show');
        Route::get('/show-destroy/{movimiento_banco}', [MovimientoBancoController::class, 'show_destroy'])->name('movimiento-banco.show-destroy')
            ->middleware('permission:movimiento-banco.destroy');
        Route::delete('/destroy/{movimiento_banco}', [MovimientoBancoController::class, 'destroy'])->name('movimiento-banco.destroy')
            ->middleware('permission:movimiento-banco.destroy');
        Route::get('/edit/{movimiento_banco}', [MovimientoBancoController::class, 'edit'])->name('movimiento-banco.edit')
            ->middleware('permission:movimiento-banco.edit');
        Route::put('/update/{movimiento_banco}', [MovimientoBancoController::class, 'update'])->name('movimiento-banco.update')
            ->middleware('permission:movimiento-banco.edit');
        //
        Route::post('/index-busca', [MovimientoBancoController::class, 'index_busca'])->name('movimiento-banco.index-busca')
            ->middleware('permission:movimiento-banco.index');
        Route::get('/index-lista/{inicio}/{final}/{banco_id}', [MovimientoBancoController::class, 'index_lista'])->name('movimiento-banco.index-lista')
            ->middleware('permission:movimiento-banco.index');
        //
        Route::get('/carga-lote', [MovimientoBancoController::class, 'carga_lote'])->name('movimiento-banco.carga-lote')
            ->middleware('permission:movimiento-banco.carga-lote');
        Route::post('/procesa-lote', [MovimientoBancoController::class, 'procesa_lote'])->name('movimiento-banco.procesa-lote')
            ->middleware('permission:movimiento-banco.carga-lote');
    });

    Route::prefix('pago')->group(function () {
        // Concilia pago web
        Route::get('/concilia-pago-web/', [PagoController::class, 'concilia_pago_web'])->name('pago.concilia')
            ->middleware('permission:pago.concilia');
        Route::post('/concilia-pago-web/', [PagoController::class, 'concilia_pago_web_procesa'])->name('pago.concilia-procesa')
            ->middleware('permission:pago.concilia');

        // Confirma pago web
        Route::get('/confirma-pago-web/', [PagoController::class, 'confirma_pago_web'])->name('pago.confirma')
            ->middleware('permission:pago.confirma');
        Route::post('/confirma-pago-web/', [PagoController::class, 'confirma_pago_web_procesa'])->name('pago.confirma-procesa')
            ->middleware('permission:pago.confirma');


        Route::get('/{taquilla}', [PagoController::class, 'index'])->name('pago.index')
            ->middleware('permission:pago.index');
        Route::get('/create/{cliente}/{taquilla}', [PagoController::class, 'create'])->name('pago.create')
            ->middleware('permission:pago.create');
        Route::post('/store/{cliente}/{taquilla}', [PagoController::class, 'store'])->name('pago.store')
            ->middleware('permission:pago.create');
        Route::get('/show/{pago}', [PagoController::class, 'show'])->name('pago.show')
            ->middleware('permission:pago.show');
        Route::get('/show-destroy/{pago}', [PagoController::class, 'show_destroy'])->name('pago.show-destroy')
            ->middleware('permission:ciudad.destroy');
        Route::delete('/destroy/{pago}', [PagoController::class, 'destroy'])->name('pago.destroy')
            ->middleware('permission:pago.destroy');
        Route::get('/edit/{pago}', [PagoController::class, 'edit'])->name('pago.edit')
            ->middleware('permission:pago.edit');
        Route::put('/update/{pago}', [PagoController::class, 'update'])->name('pago.update')
            ->middleware('permission:pago.edit');
        // Estado de Cuenta
        Route::get('/cuenta/{cliente}/{taquilla}', [PagoController::class, 'cuenta'])->name('pago.cuenta')
            ->middleware('permission:cliente.cuenta');
        // Taquilla
        Route::get('/taquilla/', [PagoController::class, 'pago_taquilla'])->name('pago.taquilla')
            ->middleware('permission:pago.taquilla');
        Route::post('/busca-pago-taquilla/', [PagoController::class, 'busca_pago_taquilla'])->name('pago.busca-pago-taquilla')
            ->middleware('permission:pago.taquilla');
        Route::get('/show-pago-taquilla/{pago_taquilla}', [PagoController::class, 'show_pago_taquilla'])->name('pago.show-pago-taquilla')
            ->middleware('permission:pago.taquilla');
        // Web
        Route::get('/web/', [PagoController::class, 'pago_web'])->name('pago.web')
            ->middleware('permission:pago.web');
        Route::post('/busca-pago-web/', [PagoController::class, 'busca_pago_web'])->name('pago.busca-pago-web')
            ->middleware('permission:pago.web');
        Route::get('/show-pago-web/{pago_web}', [PagoController::class, 'show_pago_web'])->name('pago.show-pago-web')
            ->middleware('permission:pago.web');

        // Selecciona taquilla para enviar al index
        Route::get('/', [PagoController::class, 'selecciona_taquilla'])->name('pago.selecciona-taquilla')
            ->middleware('permission:pago.index');
        Route::post('/', [PagoController::class, 'busca_taquilla'])->name('pago.busca-taquilla')
            ->middleware('permission:pago.index');


    });

    Route::prefix('pagos-web')->group(function () {
        Route::get('/web', [PagosController::class, 'web'])->name('pagos-web.web')
            ->middleware('permission:pagos-web.web');
        Route::get('/web-show/{pagos_web}', [PagosController::class, 'web_show'])->name('pagos-web.web-show')
            ->middleware('permission:pagos-web.web-show');
        Route::get('/web-show-destroy/{pagos_web}', [PagosController::class, 'web_show_destroy'])->name('pagos-web.web-show-destroy')
            ->middleware('permission:pagos-web.web-show');
        Route::delete('/web-destroy/{pagos_web}', [PagosController::class, 'web_destroy'])->name('pagos-web.web-destroy')
            ->middleware('permission:pagos-web.web-show');
    });

    Route::prefix('pagos-taquilla')->group(function () {
        Route::get('/taquilla', [PagosController::class, 'taquilla'])->name('pagos-taquilla.taquilla')
            ->middleware('permission:pagos-taquilla.taquilla');
        Route::get('/taquilla-show/{pagos_taquilla}', [PagosController::class, 'taquilla_show'])->name('pagos-taquilla.taquilla-show')
            ->middleware('permission:pagos-taquilla.taquilla-show');
    });

    Route::prefix('pago-taquilla')->group(function () {
        Route::get('/', [PagoTaquillaController::class, 'index'])->name('pago-taquilla.index')
            ->middleware('permission:pago-taquilla.index');
        Route::get('/show({pago-taquilla}', [PagoTaquillaController::class, 'show'])->name('pago-taquilla.index')
            ->middleware('permission:pago-taquilla.index');
    });


    Route::prefix('plan')->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('plan.index')
            ->middleware('permission:plan.index');
        Route::get('/create', [PlanController::class, 'create'])->name('plan.create')
            ->middleware('permission:plan.create');
        Route::post('/store', [PlanController::class, 'store'])->name('plan.store')
            ->middleware('permission:plan.create');
        Route::get('/show/{plan}', [PlanController::class, 'show'])->name('plan.show')
            ->middleware('permission:plan.show');
        Route::get('/show-destroy/{plan}', [PlanController::class, 'show_destroy'])->name('plan.show-destroy')
            ->middleware('permission:plan.destroy');
        Route::delete('/destroy/{plan}', [PlanController::class, 'destroy'])->name('plan.destroy')
            ->middleware('permission:plan.destroy');
        Route::get('/edit/{plan}', [PlanController::class, 'edit'])->name('plan.edit')
            ->middleware('permission:plan.edit');
        Route::put('/update/{plan}', [PlanController::class, 'update'])->name('plan.update')
            ->middleware('permission:plan.edit');
        // Asigna Impuesto
        Route::get('/plan-impuesto/{plan}', [PlanController::class, 'impuesto'])->name('plan.impuesto')
            ->middleware('permission:plan.impuesto');
        Route::post('/plan-impuesto/{plan}', [PlanController::class, 'store_impuesto'])->name('plan.store_impuesto')
            ->middleware('permission:plan.impuesto');
    });

    Route::prefix('recibo')->group(function () {
        Route::get('/', [ReciboController::class, 'index'])->name('recibo.index')
            ->middleware('permission:recibo.index');
        Route::get('/create', [ReciboController::class, 'create'])->name('recibo.create')
            ->middleware('permission:recibo.create');
        Route::post('/store', [ReciboController::class, 'store'])->name('recibo.store')
            ->middleware('permission:recibo.create');
        Route::get('/show/{recibo}', [ReciboController::class, 'show'])->name('recibo.show')
            ->middleware('permission:recibo.show');
        Route::get('/show-destroy/{recibo}', [ReciboController::class, 'show_destroy'])->name('recibo.show-destroy')
            ->middleware('permission:recibo.destroy');
        Route::delete('/destroy/{recibo}', [ReciboController::class, 'destroy'])->name('recibo.destroy')
            ->middleware('permission:recibo.destroy');
        Route::get('/edit/{recibo}', [ReciboController::class, 'edit'])->name('recibo.edit')
            ->middleware('permission:recibo.edit');
        Route::put('/update/{recibo}', [ReciboController::class, 'update'])->name('recibo.update')
            ->middleware('permission:recibo.edit');
        // Registro
        Route::get('/consumo-clientes', [ReciboController::class, 'recibo_clientes'])->name('recibo.recibo-cliente')
            ->middleware('permission:recibo.index');
        Route::get('/consumo/{cliente}', [ReciboController::class, 'recibo'])->name('recibo.recibo')
            ->middleware('permission:recibo.recibo');
        Route::post('/store-consumo/{cliente}', [ReciboController::class, 'store_recibo'])->name('recibo.store-recibo')
            ->middleware('permission:recibo.recibo');
        // Generar
        Route::get('/genera', [ReciboController::class, 'genera'])->name('recibo.genera')
            ->middleware('permission:recibo.genera');
        Route::post('/genera', [ReciboController::class, 'store_genera'])->name('recibo.genera')
            ->middleware('permission:recibo.genera');
        // Exonerar
        Route::get('/exonera/{cliente}', [ReciboController::class, 'exonera'])->name('recibo.exonera')
            ->middleware('permission:recibo.exonera');
        Route::post('/exonera/{cliente}', [ReciboController::class, 'store_exonera'])->name('recibo.store-exonera')
            ->middleware('permission:recibo.exonera');
        // Exonerar Reverso
        Route::get('/exonera-reverso/{cliente}', [ReciboController::class, 'exonera_reverso'])->name('recibo.exonera-reverso')
            ->middleware('permission:recibo.exonera');
        Route::post('/exonera-reverso/{cliente}', [ReciboController::class, 'store_exonera_reverso'])->name('recibo.store-exonera-reverso')
            ->middleware('permission:recibo.exonera');
        // Estado de Cuenta
        Route::get('/cuenta/{cliente}', [ReciboController::class, 'cuenta'])->name('recibo.cuenta')
            ->middleware('permission:cliente.cuenta');
        // Nota de débito
        Route::get('/create-debito/{cliente}', [ReciboController::class, 'create_debito'])->name('recibo.create-debito')
            ->middleware('permission:recibo.create');
        Route::post('/store-debito/{cliente}', [ReciboController::class, 'store_debito'])->name('recibo.store-debito')
            ->middleware('permission:recibo.create');
        // Nota de crédito
        Route::get('/create-credito/{cliente}', [ReciboController::class, 'create_credito'])->name('recibo.create-credito')
            ->middleware('permission:recibo.create');
        Route::post('/store-credito/{cliente}', [ReciboController::class, 'store_credito'])->name('recibo.store-credito')
            ->middleware('permission:recibo.create');
    });

    Route::prefix('reporte')->group(function () {
        // Reporte general de pago por fecha y por tipo
        Route::match(array('get', 'post'), '/pago-general', [ReporteController::class, 'pago_general'])->name('reporte.pago-general')->middleware('permission:reporte.pago-general');
        Route::get('/pago-general-taquilla/{desde}/{hasta}', [ReporteController::class, 'pago_general_taquilla'])->name('reporte.pago-general-taquilla')->middleware('permission:reporte.pago-general');
        Route::get('/pago-general-confirmado/{desde}/{hasta}', [ReporteController::class, 'pago_general_confirmado'])->name('reporte.pago-general-confirmado')->middleware('permission:reporte.pago-general');
        Route::get('/pago-general-conciliado/{desde}/{hasta}', [ReporteController::class, 'pago_general_conciliado'])->name('reporte.pago-general-conciliado')->middleware('permission:reporte.pago-general');
        Route::get('/pago-general-recibido/{desde}/{hasta}', [ReporteController::class, 'pago_general_recibido'])->name('reporte.pago-general-recibido')->middleware('permission:reporte.pago-general');

        // Reporte general de recibos por fecha
        Route::match(['get', 'post'], '/recibo-general', [ReporteController::class, 'recibo_general'])->name('reporte.recibo-general')->middleware('permission:reporte.recibo-general');
        Route::get('/recibo-general-recibo/{desde}/{hasta}', [ReporteController::class, 'recibo_general_recibo'])->name('reporte.recibo-general-recibo')->middleware('permission:reporte.pago-general');
        Route::get('/recibo-general-saldo/{desde}/{hasta}', [ReporteController::class, 'recibo_general_saldo'])->name('reporte.recibo-general-saldo')->middleware('permission:reporte.pago-general');
    });

    Route::prefix('taquilla')->group(function () {
        Route::get('/', [TaquillaController::class, 'index'])->name('taquilla.index')
            ->middleware('permission:taquilla.index');
        Route::get('/create', [TaquillaController::class, 'create'])->name('taquilla.create')
            ->middleware('permission:taquilla.create');
        Route::post('/store', [TaquillaController::class, 'store'])->name('taquilla.store')
            ->middleware('permission:taquilla.create');
        Route::get('/show/{taquilla}', [TaquillaController::class, 'show'])->name('taquilla.show')
            ->middleware('permission:taquilla.show');
        Route::get('/show-destroy/{taquilla}', [TaquillaController::class, 'show_destroy'])->name('taquilla.show-destroy')
            ->middleware('permission:taquilla.destroy');
        Route::delete('/destroy/{taquilla}', [TaquillaController::class, 'destroy'])->name('taquilla.destroy')
            ->middleware('permission:taquilla.destroy');
        Route::get('/edit/{taquilla}', [TaquillaController::class, 'edit'])->name('taquilla.edit')
            ->middleware('permission:taquilla.edit');
        Route::put('/update/{taquilla}', [TaquillaController::class, 'update'])->name('taquilla.update')
            ->middleware('permission:taquilla.edit');
    });

    Route::prefix('tipo-equipo')->group(function () {
        Route::get('/', [TipoEquipoController::class, 'index'])->name('tipo-equipo.index')
            ->middleware('permission:tipo-equipo.index');
        Route::get('/create', [TipoEquipoController::class, 'create'])->name('tipo-equipo.create')
            ->middleware('permission:tipo-equipo.create');
        Route::post('/store', [TipoEquipoController::class, 'store'])->name('tipo-equipo.store')
            ->middleware('permission:tipo-equipo.create');
        Route::get('/show/{tipo_equipo}', [TipoEquipoController::class, 'show'])->name('tipo-equipo.show')
            ->middleware('permission:tipo-equipo.show');
        Route::get('/show-destroy/{tipo_equipo}', [TipoEquipoController::class, 'show_destroy'])->name('tipo-equipo.show-destroy')
            ->middleware('permission:tipo-equipo.destroy');
        Route::delete('/destroy/{tipo_equipo}', [TipoEquipoController::class, 'destroy'])->name('tipo-equipo.destroy')
            ->middleware('permission:tipo-equipo.destroy');
        Route::get('/edit/{tipo_equipo}', [TipoEquipoController::class, 'edit'])->name('tipo-equipo.edit')
            ->middleware('permission:tipo-equipo.edit');
        Route::put('/update/{tipo_equipo}', [TipoEquipoController::class, 'update'])->name('tipo-equipo.update')
            ->middleware('permission:tipo-equipo.edit');
    });

    Route::prefix('usuario')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('usuario.index')
            ->middleware('permission:usuario.index');
        Route::get('/create/', [UserController::class, 'create'])->name('usuario.create')
            ->middleware('permission:usuario.create');
        Route::post('/store', [UserController::class, 'store'])->name('usuario.store')
            ->middleware('permission:usuario.create');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('usuario.show')
            ->middleware('permission:usuario.show');
        Route::get('/show-destroy/{user}', [UserController::class, 'show_destroy'])->name('usuario.show-destroy')
            ->middleware('permission:usuario.destroy');
        Route::put('/destroy/{user}', [UserController::class, 'destroy'])->name('usuario.destroy')
            ->middleware('permission:usuario.destroy');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('usuario.edit')
            ->middleware('permission:usuario.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('usuario.update')
            ->middleware('permission:usuario.edit');
        // Password
        Route::get('/edit-password/{user}', [UserController::class, 'edit_password'])->name('usuario.edit-password')
            ->middleware('permission:usuario.edit-password');
        Route::put('/update-password/{user}', [UserController::class, 'update_password'])->name('usuario.update-password')
            ->middleware('permission:usuario.edit-password');
        // Permisos
        Route::get('/edit-permission/{user}', [UserController::class, 'edit_permission'])->name('usuario.edit-permission')
            ->middleware('permission:usuario.edit-permission');
        Route::put('/update-permission/{user}', [UserController::class, 'update_permission'])->name('usuario.update-permission')
            ->middleware('permission:usuario.edit-permission');
        // Mostrar eliminados
        Route::get('/show-deleted-user', [UserController::class, 'show_deleted_users'])->name('usuario.show-deleted-user')
            ->middleware('permission:usuario.show-deleted-user');
    });

    Route::prefix('zona')->group(function () {
        Route::get('/', [ZonaController::class, 'index'])->name('zona.index')
            ->middleware('permission:zona.index');
        Route::get('/create', [ZonaController::class, 'create'])->name('zona.create')
            ->middleware('permission:zona.create');
        Route::post('/store', [ZonaController::class, 'store'])->name('zona.store')
            ->middleware('permission:zona.create');
        Route::get('/show/{zona}', [ZonaController::class, 'show'])->name('zona.show')
            ->middleware('permission:zona.show');
        Route::get('/show-destroy/{zona}', [ZonaController::class, 'show_destroy'])->name('zona.show-destroy')
            ->middleware('permission:zona.destroy');
        Route::delete('/destroy/{zona}', [ZonaController::class, 'destroy'])->name('zona.destroy')
            ->middleware('permission:zona.destroy');
        Route::get('/edit/{zona}', [ZonaController::class, 'edit'])->name('zona.edit')
            ->middleware('permission:zona.edit');
        Route::put('/update/{zona}', [ZonaController::class, 'update'])->name('zona.update')
            ->middleware('permission:zona.edit');
    });
});
