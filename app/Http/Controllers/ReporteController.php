<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Excel;

use App\Exports\PagoTaquillaReporteExport;
use App\Exports\PagoWebConfirmadoExport;
use App\Exports\PagoWebConciliadoExport;
use App\Exports\PagoWebRecibidoExport;
use App\Exports\ReciboExport;
use App\Exports\ReporteGeneralSaldoExport;


use App\Models\PagoTaquilla;
use App\Models\PagoWeb;
use App\Models\Recibo;
use App\Models\Cliente;
use App\Models\ReporteGeneralSaldo;

class ReporteController extends Controller
{
    public function pago_general(Request $request)
    {
        $inicio = date('Y-m-d', strtotime($request->get('inicio')));
        $final = date('Y-m-d', strtotime($request->get('final')));

        if ($request->isMethod('get')) {
            $pago_taquillas = null;
            $pago_web_confirmados = null;
            $pago_web_conciliados = null;
            $pago_web_recibidos = null;
            $num_clientes = 0;
            $desde = '';
            $hasta = '';
            $recibo_totales = '';
            $recibos = '';
            $num_clientes_insolventes = null;
            return view('admin.reporte.pago_general', compact('pago_taquillas', 'pago_web_confirmados', 'pago_web_conciliados', 'pago_web_recibidos', 'desde', 'hasta', 'num_clientes', 'recibo_totales', 'recibos', 'num_clientes_insolventes'));
        }

        if ($request->isMethod('post')) {
            if ($request->get('inicio') == null || $request->get('final') == null) {
                session()->flash('warning', 'Debe señalar la fecha de inicio y la de final');
                return redirect()->route('reporte.pago-general');
            }

            if ($inicio > $final) {

                session()->flash('warning', 'Fecha de inicio es mayor que fecha final');
                return redirect()->route('reporte.pago-general');
            } else {

                /* $pts = PagoTaquilla::all();

                foreach($pts as $pt) {
                    $pt->fecha = $fecha = date('Y-m-d', strtotime($pt->created_at));
                    $pt->save();
                }

                $ws = PagoWeb::all();

                foreach ($ws as $w) {
                    $w->fecha = $fecha = date('Y-m-d', strtotime($w->created_at));
                    $w->save();
                } */

                $pago_taquillas = PagoTaquilla::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
                    ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
                    ->orderBy('pago_taquilla', 'asc')
                    ->with('cliente')
                    ->with('banco_pos')
                    ->get();

                $pago_web_confirmados = PagoWeb::where('created_at', '>=', $inicio . 'T00:00:00.00000Z')
                    ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
                    ->where('confirmado', true)
                    ->orderBy('pago_web', 'asc')
                    ->with('cliente')
                    ->with('banco_origen')
                    ->with('banco_destino')
                    ->get();

                $pago_web_conciliados = PagoWeb::where('created_at', '>=', $inicio . 'T00:00:00.00000Z')
                    ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
                    ->where('conciliado', true)
                    ->where('confirmado', false)
                    ->orderBy('pago_web', 'asc')
                    ->with('cliente')
                    ->with('banco_origen')
                    ->with('banco_destino')
                    ->get();

                $pago_web_recibidos = PagoWeb::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
                    ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
                    ->where('conciliado', false)
                    ->where('confirmado', false)
                    ->orderBy('pago_web', 'asc')
                    ->with('cliente')
                    ->with('banco_origen')
                    ->with('banco_destino')
                    ->get();

                $recibos = Recibo::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
                    ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
                    ->where('saldo', '>', 0)
                    ->get()
                    ->groupBy(function ($data) {
                        return $data->cliente_id;
                    });

                /*  $clientes_insolventes = Recibo::where('created_at', '<=', $final . 'T23:59:59.000000Z')
                    ->where('saldo', '>', 0)
                    ->get()
                    ->groupBy(function ($data) {
                        return $data->cliente_id;
                    }); */

                $clientes = Cliente::where('activo', true)->get();

                $recibo_totales = Recibo::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
                    ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
                    ->where('saldo', '>', 0)
                    ->orderBy('cliente_id', 'asc')
                    ->with('cliente')
                    ->get();

                // dd($recibo_total);
                // $clientes = Cliente::all();

                $num_clientes_insolventes = $recibos->count();

                $num_clientes = $clientes->count();

                $desde = date('d-m-Y', strtotime($request->get('inicio')));
                $hasta = date('d-m-Y', strtotime($request->get('final')));

                /*   dd($clientes_insolventes); */

                return view('admin.reporte.pago_general', compact('pago_taquillas', 'pago_web_confirmados', 'pago_web_conciliados', 'pago_web_recibidos', 'desde', 'hasta', 'num_clientes', 'recibo_totales', 'recibos', 'num_clientes_insolventes'));
            }
        }
    }

    public function pago_general_taquilla(Excel $excel, $desde, $hasta)
    {
        $sub_desde = str_replace('-', '', (string)$desde);
        $sub_hasta = str_replace('-', '', (string)$hasta);
        return $excel->download(new PagoTaquillaReporteExport($desde, $hasta), 'pago_taquilla_' . $sub_desde . '_' . $sub_hasta . '.xlsx');
    }

    public function pago_general_confirmado(Excel $excel, $desde, $hasta)
    {
        $sub_desde = str_replace('-', '', (string)$desde);
        $sub_hasta = str_replace('-', '', (string)$hasta);
        return $excel->download(new PagoWebConfirmadoExport($desde, $hasta), 'pago_web_confirmado_' . $sub_desde . '_' . $sub_hasta . '.xlsx');
    }

    public function pago_general_conciliado(Excel $excel, $desde, $hasta)
    {
        $sub_desde = str_replace('-', '', (string)$desde);
        $sub_hasta = str_replace('-', '', (string)$hasta);
        return $excel->download(new PagoWebConciliadoExport($desde, $hasta), 'pago_web_conciliado_' . $sub_desde . '_' . $sub_hasta . '.xlsx');
    }

    public function pago_general_recibido(Excel $excel, $desde, $hasta)
    {
        $sub_desde = str_replace('-', '', (string)$desde);
        $sub_hasta = str_replace('-', '', (string)$hasta);
        return $excel->download(new PagoWebRecibidoExport($desde, $hasta), 'pago_web_no_confirmado_conciliado_' . $sub_desde . '_' . $sub_hasta . '.xlsx');
    }

    public function recibo_general(Request $request)
    {
        $inicio = date('Y-m-d', strtotime($request->get('inicio')));
        $final = date('Y-m-d', strtotime($request->get('final')));

        if ($request->isMethod('get')) {
            $recibos = null;
            $desde = '';
            $hasta = '';
            return view('admin.reporte.recibo_general', compact('recibos', 'desde', 'hasta'));
        }

        if ($request->isMethod('post')) {
            if ($request->get('inicio') == null || $request->get('final') == null) {
                session()->flash('warning', 'Debe señalar la fecha de inicio y la de final');
                return redirect()->route('reporte.recibo-general');
            }

            if ($inicio > $final) {
                session()->flash('warning', 'Fecha de inicio es mayor que fecha final');
                return redirect()->route('reporte.pago-general');
            } else {
                $recibos = Recibo::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
                    ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
                    ->with('cliente')
                    ->get();

                $desde = date('d-m-Y', strtotime($request->get('inicio')));
                $hasta = date('d-m-Y', strtotime($request->get('final')));

                return view('admin.reporte.recibo_general', compact('recibos', 'desde', 'hasta'));
            }
        }
    }

    public function recibo_general_recibo(Excel $excel, $desde, $hasta)
    {
        $sub_desde = str_replace('-', '', (string)$desde);
        $sub_hasta = str_replace('-', '', (string)$hasta);
        return $excel->download(new ReciboExport($desde, $hasta), 'consumos_' . $sub_desde . '_' . $sub_hasta . '.xlsx');
    }


    public function recibo_general_saldo(Excel $excel, $desde, $hasta)
    {
        $sub_desde = str_replace('-', '', (string)$desde);
        $sub_hasta = str_replace('-', '', (string)$hasta);

        $inicio = date('Y-m-d', strtotime($desde));
        $final = date('Y-m-d', strtotime($hasta));

        try {
            $rgs = ReporteGeneralSaldo::all();
            foreach ($rgs as $r) {
                $r->delete();
            }
        } catch (\Illuminate\Database\QueryException $e) {
            session()->flash('warning', 'Error en borrado de data');
        }

        $recibo_totales = Recibo::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
            ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
            ->where('saldo', '>', 0)
            ->orderBy('cliente_id', 'asc')
            ->with('cliente')
            ->get();

        $nombre = '';
        foreach($recibo_totales as $rt) {
            $rgs = new ReporteGeneralSaldo;

            if ($nombre != $rt->cliente->nombres . ' ' . $rt->cliente->apellidos) {
                $rgs->cliente = $rt->cliente->nombres . ' ' . $rt->cliente-> apellidos . ' ' . $rt->cliente->cedula;
            } else {
                $rgs->cliente = '';
            }
            $rgs->fecha = (string)date('d-m-Y', strtotime($rt->fecha));
            $rgs->numero = $rt->numero;
            $rgs->concepto = $rt->concepto;
            $rgs->monto_divisa = $rt->monto_divisa;
            $rgs->saldo = $rt->saldo;
            $rgs->save();
            $nombre = $rgs->cliente;
        }

        return $excel->download(new ReporteGeneralSaldoExport(), 'cliente_insolventes' . $sub_desde . '_' . $sub_hasta . '.xlsx');
        // return;
    }
}
