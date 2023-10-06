<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePagoRequest;
use App\Http\Requests\UpdatePagoRequest;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Cliente;
use App\Models\Recibo;
use App\Models\PagoTaquilla;
use App\Models\PagoWeb;
use App\Models\MovimientoBanco;
use App\Models\Divisa;
use App\Models\Banco;
use App\Models\Taquilla;
use App\Models\Log;
use Illuminate\Support\Carbon;


class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Taquilla $taquilla)
    {
        return view('admin.pago.index', compact('taquilla'));
    }


    public function selecciona_taquilla()
    {
        $taquillas = Taquilla::orderBy('taquilla', 'asc')->get();
        return view('admin.pago.selecciona_taquilla', compact('taquillas'));
    }

    public function busca_taquilla(Request $request)
    {
        $taquilla = $request->get('taquilla_id');
        return redirect()->route('pago.index', ['taquilla' => $taquilla]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Cliente $cliente, Taquilla $taquilla)
    {
        $recibos = Recibo::where('cliente_id', $cliente->id)
            ->where('saldo', '>', 0)
            ->orderBy('id', 'asc')
            ->get();
        $divisas = Divisa::orderBy('descripcion', 'asc')->first();
        $bancos = Banco::orderBy('banco', 'asc')->get();
        return view('admin.pago.form', compact('cliente', 'recibos', 'divisas', 'bancos', 'taquilla'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cliente $cliente, Taquilla $taquilla)
    {
        $monto_efectivo_bs = $request->get('monto_efectivo_bs');
        $monto_efectivo_divisa = $request->get('monto_efectivo_divisa');
        $monto_pos = $request->get('monto_pos');
        if ($monto_efectivo_bs == null) {
            $monto_efectivo_bs = 0;
        }
        if ($monto_efectivo_divisa == null) {
            $monto_efectivo_divisa = 0;
        }
        if ($monto_pos == null) {
            $monto_pos = 0;
        }
        $recibo_id = $request->get('recibo_id');
        $divisa_id = $request->get('divisa_id');
        $banco_id = $request->get('banco_id');

        if ($monto_efectivo_bs == 0 && $monto_efectivo_divisa == 0 && $monto_pos == 0) {
            session()->flash('error', 'Los montos a cancelar están en cero (0)');
            return redirect()->route('pago.create', ['cliente' => $cliente->id, 'taquilla' => $taquilla->id]);
        }

        if ($recibo_id == null) {
            session()->flash('warning', 'Debe seleccionar uno o mas consumos');
            return redirect()->route('pago.create', ['cliente' => $cliente->id, 'taquilla' => $taquilla->id]);
        }

        $divisa = Divisa::where('id', $divisa_id)->first();
        $monto_divisa_bs = $monto_efectivo_bs / $divisa->tasa;
        $monto_divisa_pos = $monto_pos / $divisa->tasa;
        $resto = $monto_efectivo_divisa + $monto_divisa_bs + $monto_divisa_pos;
        $acumulador = 0;
        foreach ($recibo_id as $r) {
            $recibo =  Recibo::where('id', (int)$r)->first();
            $acumulador += $recibo->saldo;
        }
        if ($acumulador < $resto) {
            session()->flash('warning', 'El total pagado ' . number_format($resto, 2, ',', '.') . ' es mayor que el monto a pagar');
            return redirect()->route('pago.create', ['cliente' => $cliente->id, 'taquilla' => $taquilla->id]);
        }


        $fecha_actual = Carbon::now();
        switch ($fecha_actual->month) {
            case 1:
                $mes = 'ENE';
                $mes_largo = 'ENERO';
                break;
            case 2:
                $mes = 'FEB';
                $mes_largo = 'FEBRERO';
                break;
            case 3:
                $mes = 'MAR';
                $mes_largo = 'MARZO';
                break;
            case 4:
                $mes = 'ABR';
                $mes_largo = 'ABRIL';
                break;
            case 5:
                $mes = 'MAY';
                $mes_largo = 'MAYO';
                break;
            case 6:
                $mes = 'JUN';
                $mes_largo = 'JUNIO';
                break;
            case 7:
                $mes = 'JUL';
                $mes_largo = 'JULIO';
                break;
            case 8:
                $mes = 'AGO';
                $mes_largo = 'AGOSTO';
                break;
            case 9:
                $mes = 'SEP';
                $mes_largo = 'SEPTIEMBRE';
                break;
            case 10:
                $mes = 'OCT';
                $mes_largo = 'OCTUBRE';
                break;
            case 11:
                $mes = 'NOV';
                $mes_largo = 'NOVIEMBRE';
                break;
            case 12:
                $mes = 'DIC';
                $mes_largo = 'DICIEMBRE';
                break;
        }

        $pago_taquilla = new PagoTaquilla;
        $pago_taquilla->monto_total = $resto;
        $pago_taquilla->monto_efectivo_bs = $monto_efectivo_bs;
        $pago_taquilla->monto_efectivo_divisa = $monto_efectivo_divisa;
        $pago_taquilla->monto_pos = $monto_pos;
        $pago_taquilla->tasa = $divisa->tasa;
        $pago_taquilla->divisa_id = $divisa->id;
        $pago_taquilla->banco_pos_id = $banco_id;
        $pago_taquilla->taquilla_id = $taquilla->id;
        $pago_taquilla->pago_taquilla = '';
        $pago_taquilla->cliente_id = $cliente->id;
        $pago_taquilla->fecha = Carbon::now()->format('Y/m/d');
        $pago_taquilla->save();
        $pago_taquilla->pago_taquilla = 'P-' . $mes . '-' . substr(strval($fecha_actual->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $pago_taquilla->id;
        $pago_taquilla->save();
        $log = new Log();
        $log->register($log, 'C', 'Pago por taquilla ' . $pago_taquilla->pago_taquilla . ' Taquilla ' . $pago_taquilla->taquilla->taquilla, $pago_taquilla->id, "pago_taquillas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);

        foreach ($recibo_id as $r) {
            $recibo = Recibo::where('id', (int)$r)->first();
            if ($resto > 0) {

                $pago = new Pago;

                if ($recibo->saldo <= $resto) {
                    $resto -= $recibo->saldo;
                    $pago->monto_total = $recibo->saldo;
                    $pago->concepto = 'Pago total de ' . $recibo->numero;
                    $recibo->saldo = 0;
                    $recibo->pagada = true;
                } else {
                    $recibo->saldo -= $resto;
                    $pago->monto_total = $resto;
                    $pago->concepto = 'Pago parcial de ' . $recibo->numero;
                    $resto = 0;
                }
                $recibo->save();
                $pago->pago = '';
                $pago->origen = 'Taquilla';
                $pago->numero_pago = $pago_taquilla->pago_taquilla;
                $pago->recibo_id = $recibo->id;
                $pago->save();
                $pago->pago = 'R-' . $mes . '-' . substr(strval($fecha_actual->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $pago->id;
                $pago->save();
                $log = new Log();
                $log->register($log, 'C', 'Pago de consumo ' . $recibo->numero . ' a ' . $cliente->nombres . ' ' . $cliente->apellidos, $pago->id, "pagos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            }
        }

        session()->flash('message', 'Pago registrado');

        return redirect()->route('pago.index', ['taquilla' => $taquilla->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePagoRequest  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePagoRequest $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }

    public function cuenta(Cliente $cliente, Taquilla $taquilla)
    {
        $recibos = Recibo::where('cliente_id', $cliente->id)->orderBy('created_at', 'desc')->get();
        $array_pagos = [];
        foreach ($recibos as $recibo) {
            $pagos = Pago::where('recibo_id', $recibo->id)->get();
            foreach ($pagos as $pago) {
                $fecha = date("d-m-Y", strtotime($pago->created_at));
                array_push($array_pagos, ['recibo_id' => $recibo->id, 'fecha' => $fecha, "concepto" => $pago->concepto, "num_referencia" => $pago->pago, "monto_total" => $pago->monto_total]);
            }
        }
        return view('admin.pago.cuenta', compact('cliente', 'recibos', 'array_pagos', 'taquilla'));
    }


    public function pago_taquilla()
    {
        return view('admin.pago.pago_taquilla');
    }


    public function busca_pago_taquilla(Request $request)
    {
        if ($request->get('inicio') == null || $request->get('final') == null) {
            session()->flash('warning', 'Debe señalar la fecha de inicio y la de final');
            return redirect()->route('pago.web');
        }
        $inicio = date('Y-m-d', strtotime($request->get('inicio')));
        $final = date('Y-m-d', strtotime($request->get('final')));
        $taquilla_id = $request->get('taquilla_id');
        if ($inicio > $final) {
            session()->flash('warning', 'Fecha de inicio es mayor que fecha final');
            return redirect()->route('pago.taquilla');
        }
        return view('admin.pago.lista_pago_taquilla', compact('inicio', 'final', 'taquilla_id'));
    }


    public function show_pago_taquilla()
    {
        //
    }


    public function pago_web()
    {
        return view('admin.pago.pago_web');
    }


    public function busca_pago_web(Request $request)
    {
        if ($request->get('inicio') == null || $request->get('final') == null) {
            session()->flash('warning', 'Debe señalar la fecha de inicio y la de final');
            return redirect()->route('pago.web');
        }
        $inicio = date('Y-m-d', strtotime($request->get('inicio')));
        $final = date('Y-m-d', strtotime($request->get('final')));

        if ($inicio > $final) {
            session()->flash('warning', 'Fecha de inicio es mayor que fecha final');
            return redirect()->route('pago.web');
        }
        return view('admin.pago.lista_pago_web', compact('inicio', 'final'));
    }


    public function show_pago_web(PagoWeb $pago_web)
    {
        return view('admin.pago.show_pago_web', compact('pago_web'));
    }



    public function concilia_pago_web()
    {
        return view('admin.pago.concilia_pago_web');
    }


    public function concilia_pago_web_procesa(Request $request)
    {
        if ($request->get('inicio') == null || $request->get('final') == null) {
            session()->flash('warning', 'Debe señalar la fecha de inicio y la de final');
            return redirect()->route('pago.concilia');
        }
        $inicio = date('Y-m-d', strtotime($request->get('inicio')));
        $final = date('Y-m-d', strtotime($request->get('final')));

        if ($inicio > $final) {
            session()->flash('warning', 'Fecha de inicio es mayor que fecha final');
            return redirect()->route('pago.concilia');
        }

        //dd(gettype($inicio));
        if ($inicio === $final) {
            $movimientos = MovimientoBanco::where('fecha', $inicio)->orderBy('fecha', 'asc')->get();
        } else {
            $movimientos = MovimientoBanco::where('fecha', '>=', $inicio)->where('fecha', '<=', $final)->orderBy('fecha', 'asc')->get();
        }

        $pago_webs = PagoWeb::where('confirmado', false)->where('conciliado', false)->orderBy('pago_web', 'asc')->get();
        $conciliado = 0;
        foreach ($pago_webs as $pago_web) {
            foreach ($movimientos as $movimiento) {
                //dd($pago_web->monto == $movimiento->monto);
                $fecha = date_format($pago_web->created_at, 'Y-m-d');
                if (($pago_web->num_referencia == $movimiento->referencia ||
                    $pago_web->cedula == stristr($movimiento->cedula, $pago_web->cedula) ||
                    $pago_web->telefono_celular == stristr($movimiento->telefono, $pago_web->telefono_celular) &&
                    ($fecha == $movimiento->fecha &&
                        $pago_web->banco_destino_id == $movimiento->banco_id &&
                        $pago_web->monto == $movimiento->monto))) {
                    if ($pago_web->conciliado == false) {
                        $pago_web->conciliado = true;
                        $pago_web->save();
                        $conciliado += 1;
                    }
                }
            }
        }
        if ($conciliado > 0) {
            session()->flash('message', 'Conciliado(s) ' . (string)$conciliado . ' pago(s)');
        } else {
            session()->flash('error', 'No se conciliaron pagos');
        }
        return redirect()->route('dashboard');
    }


    public function confirma_pago_web()
    {
        $pago_webs = PagoWeb::where('confirmado', false)->orderBy('pago_web', 'asc')->get();
        // dd($pago_webs);
        return view('admin.pago.confirma_pago_web', compact('pago_webs'));
    }


    public function confirma_pago_web_procesa(Request $request)
    {
        $fecha_actual = Carbon::now();
        switch ($fecha_actual->month) {
            case 1:
                $mes = 'ENE';
                $mes_largo = 'ENERO';
                break;
            case 2:
                $mes = 'FEB';
                $mes_largo = 'FEBRERO';
                break;
            case 3:
                $mes = 'MAR';
                $mes_largo = 'MARZO';
                break;
            case 4:
                $mes = 'ABR';
                $mes_largo = 'ABRIL';
                break;
            case 5:
                $mes = 'MAY';
                $mes_largo = 'MAYO';
                break;
            case 6:
                $mes = 'JUN';
                $mes_largo = 'JUNIO';
                break;
            case 7:
                $mes = 'JUL';
                $mes_largo = 'JULIO';
                break;
            case 8:
                $mes = 'AGO';
                $mes_largo = 'AGOSTO';
                break;
            case 9:
                $mes = 'SEP';
                $mes_largo = 'SEPTIEMBRE';
                break;
            case 10:
                $mes = 'OCT';
                $mes_largo = 'OCTUBRE';
                break;
            case 11:
                $mes = 'NOV';
                $mes_largo = 'NOVIEMBRE';
                break;
            case 12:
                $mes = 'DIC';
                $mes_largo = 'DICIEMBRE';
                break;
        }
        $pago_webs = $request->get('pago_web_id');

        foreach ($pago_webs as $pw) {
            $pago_web = PagoWeb::where('id', (int)$pw)->first();
            $recibos = Recibo::where('cliente_id', (int)$pago_web->cliente_id)->where('saldo', '>', 0)->orderBy('numero', 'asc')->get();
            $resto = $pago_web->monto / $pago_web->tasa;

            foreach ($recibos as $recibo) {
                if ($resto > 0) {

                    $pago = new Pago;

                    if ($recibo->saldo <= $resto) {
                        $resto -= $recibo->saldo;
                        $pago->monto_total = $recibo->saldo;
                        $pago->concepto = 'Pago total de ' . $recibo->numero;
                        $recibo->saldo = 0;
                        $recibo->pagada = true;
                    } else {
                        $recibo->saldo -= $resto;
                        $pago->monto_total = $resto;
                        $pago->concepto = 'Pago parcial de ' . $recibo->numero;
                        $resto = 0;
                    }

                    $recibo->save();
                    $pago->pago = '';
                    $pago->origen = 'Web';
                    $pago->numero_pago = $pago_web->pago_web;
                    $pago->recibo_id = $recibo->id;
                    $pago->save();
                    $pago->pago = 'R-' . $mes . '-' . substr(strval($fecha_actual->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $pago_web->cliente_id, -4) . '-' . $pago->id;
                    $pago->save();
                    $log = new Log();
                    $log->register($log, 'C', 'Pago de consumo ' . $recibo->numero . ' a ' . $pago_web->cliente->nombres . ' ' . $pago_web->cliente->apellidos, $pago->id, "pagos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
                }
            }
            $pago_web->confirmado = true;
            $pago_web->save();
        }

        session()->flash('message', 'Pago(s) registrado(s)');
        return redirect()->route('dashboard');
    }
}