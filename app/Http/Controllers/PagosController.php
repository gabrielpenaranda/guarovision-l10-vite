<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PagoWeb;
use App\Models\PagoTaquilla;
use App\Models\Log;

class PagosController extends Controller
{
    public function web()
    {
        return view('admin.pagos.web');
    }


    public function web_show(PagoWeb $pagos_web)
    {
        return view('admin.pagos.web_show', compact('pagos_web'));
    }

    public function web_show_destroy(PagoWeb $pagos_web)
    {
        return view('admin.pagos.web_show_destroy', compact('pagos_web'));
    }

    public function web_destroy(PagoWeb $pagos_web)
    {
        if ($pagos_web->confirmado) {
            session()->flash('warning', 'No es posible eliminar el pago, ya ha sido confirmado');
            return redirect()->route('pagos-web.web');
        }

        if ($pagos_web->conciliado) {
            session()->flash('warning', 'No es posible eliminar el pago, ya ha sido conciliado');
            return redirect()->route('pagos-web.web');
        }

        try {
            $pagos_web->delete();
            $log = new Log;
            $log->register($log, 'D', $pagos_web->pago_web, $pagos_web->id, "pago_webs", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Pago Web eliminado');
            return redirect()->route('pagos-web.web');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el pago, posee información relacionada');
                return redirect()->route('pagos-web.web');
            }
        }
    }


    public function taquilla()
    {
        return view('admin.pagos.taquilla');
    }


    public function taquilla_show(PagoTaquilla $pagos_taquilla)
    {
        return view('admin.pagos.taquilla_show', compact('pagos_taquilla'));
    }
}