<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReciboRequest;
use App\Http\Requests\UpdateReciboRequest;
use Illuminate\Http\Request;
use App\Models\Recibo;
use App\Models\Pago;
use App\Models\PagoExento;
use App\Models\PagoWeb;
use App\Models\PagoTaquilla;
use App\Models\MesConsumido;
use App\Models\Cliente;
use App\Models\Concepto;
use App\Models\Divisa;
use App\Models\Log;
use Illuminate\Support\Carbon;

class ReciboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.recibo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReciboRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReciboRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function show(Recibo $recibo)
    {
        return view('admin.recibo.show', compact('recibo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function edit(Recibo $recibo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReciboRequest  $request
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReciboRequest $request, Recibo $recibo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recibo  $recibo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recibo $recibo)
    {
        //
    }

    public function genera()
    {
        $fecha = Carbon::now();
        $consumido = MesConsumido::where('month', $fecha->month)->where('year', $fecha->year)->first();
        //dd($consumido);
        return view('admin.recibo.genera', compact('consumido', 'fecha'));
    }

    public function store_genera(Request $request)
    {
        $dias_vencimiento = (int)$request->get('dias_vencimiento');
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
        $clientes = Cliente::orderBy('id', 'asc')->get();
        foreach ($clientes as $cliente) {
            $fecha = Carbon::now();
            $fecha_recibo = Carbon::create($fecha->year, $fecha->month, 01, 0);
            if ($cliente->activo) {
                $plan = $cliente->plan->plan;
                $tarifa = $cliente->plan->tarifa;
                $divisa_id = $cliente->plan->divisa->id;
                $tasa = $cliente->plan->divisa->tasa;
                $recibo = new Recibo;
                $recibo->numero = '0';
                $recibo->fecha = date("Y-m-d", strtotime($fecha_recibo));
                $recibo->fecha_vencimiento = date("Y-m-d", strtotime($fecha_recibo->addDays($dias_vencimiento)));
                $recibo->concepto = 'PLAN ' . $plan . ' ' . $mes_largo . ' ' . $fecha->year;
                $recibo->monto_divisa = $tarifa;
                $recibo->saldo = $tarifa;
                $recibo->divisa_id = $divisa_id;
                $recibo->cliente_id = $cliente->id;
                $recibo->save();
                /* $impuestos_plan = $cliente->plan->impuestos;
                $acumulador_impuesto = 0;
                foreach ($impuestos_plan as $ip) {
                    if ($ip->es_activo) {
                        $monto_impuesto = $recibo->monto_divisa * ($ip->tasa / 100);
                        $recibo->impuestos()->attach($ip->id, array('monto_impuesto' => $monto_impuesto));
                        $acumulador_impuesto += $monto_impuesto;
                    }
                }
                $recibo->monto_divisa_impuestos = $recibo->monto_divisa + $acumulador_impuesto;
                $recibo->saldo = $recibo->monto_divisa_impuestos;
                $recibo->monto_bs = $recibo->monto_divisa_impuestos * $recibo->tasa; */
                $recibo->numero = 'S-' . $mes . '-' . substr(strval($fecha->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $recibo->id;
                $recibo->save();
            }
        }
        $mes_consumido = new MesConsumido;
        $mes_consumido->month = $fecha_actual->month;
        $mes_consumido->year = $fecha_actual->year;
        $mes_consumido->save();
        $log = new Log();
        $log->register($log, 'C', 'Generación de comprobantes de consumo de ' . $fecha_actual->month . '/' . $fecha_actual->year, 0, "recibos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Consumo del mes actual generado correctamente');
        return redirect()->route('dashboard');
    }

    public function recibo_clientes()
    {
        return view('admin.recibo.recibo-cliente-index');
    }

    public function recibo(Cliente $cliente)
    {
        $conceptos = Concepto::orderBy('concepto', 'asc')->get();
        return view('admin.recibo.form', compact('cliente', 'conceptos'));
    }

    public function cuenta(Cliente $cliente)
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
        // dd($array_pagos);
        return view('admin.recibo.cuenta', compact('cliente', 'recibos', 'array_pagos'));
    }

    public function store_recibo(Request $request, Cliente $cliente)
    {
        $concepto = Concepto::where('concepto', $request->get('concepto'))->first();
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
        $fecha = Carbon::now();
        if ($cliente->activo) {
            $tarifa = $concepto->tarifa;
            $divisa_id = $concepto->divisa->id;
            $tasa = $concepto->divisa->tasa;
            $recibo = new Recibo;
            $recibo->numero = '0';
            $recibo->fecha = date("Y-m-d", strtotime($fecha));
            $recibo->fecha_vencimiento = date("Y-m-d", strtotime($fecha));
            $recibo->concepto = $concepto->concepto;
            $recibo->monto_divisa = $tarifa;
            $recibo->saldo = $tarifa;
            $recibo->divisa_id = $divisa_id;
            $recibo->cliente_id = $cliente->id;
            $recibo->save();
            /* $concepto_impuestos = $concepto->impuestos;
            $acumulador_impuesto = 0;
            foreach ($concepto_impuestos as $ip) {
                if ($ip->es_activo) {
                    $monto_impuesto = $recibo->monto_divisa * ($ip->tasa / 100);
                    $recibo->impuestos()->attach($ip->id, array('monto_impuesto' => $monto_impuesto));
                    $acumulador_impuesto += $monto_impuesto;
                }
            }
            $recibo->monto_divisa_impuestos = $recibo->monto_divisa + $acumulador_impuesto;
            $recibo->saldo = $recibo->monto_divisa_impuestos;
            $recibo->monto_bs = $recibo->monto_divisa_impuestos * $tasa; */
            $recibo->numero = 'S-' . $mes . '-' . substr(strval($fecha->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $recibo->id;
            $recibo->save();
            $log = new Log();
            $log->register($log, 'C', 'Registro de comprobante de consumo por ' . $recibo->concepto . ' a ' . $cliente->nombres . ' ' . $cliente->apellidos, $recibo->id, "recibos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Consumo registrado correctamente');
        } else {
            session()->flash('error', 'Cliente inactivo, no se puede generar consumo');
        }
        return redirect()->route('recibo.recibo-cliente');
    }

    public function exonera(Cliente $cliente)
    {
        $recibos = Recibo::where('cliente_id', $cliente->id)->where('saldo', '>', 0)->get();
        return view('admin.recibo.exonera', compact('cliente', 'recibos'));
    }

    public function store_exonera(Request $request, Cliente $cliente)
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
        $recibo_id = $request->get('recibo_id');
        // dd($recibo_id);
        if ($recibo_id != null) {
            foreach ($recibo_id as $r) {
                $recibo = Recibo::where('id', (int)$r)->first();
                $pago_exento = new PagoExento;
                $pago_exento->monto = $recibo->saldo;
                $pago_exento->monto_divisa = $recibo->saldo;
                $pago_exento->divisa_id = $recibo->divisa_id;
                $pago_exento->pago_exento = '';
                $pago_exento->save();
                $pago_exento->pago_exento = 'E-' . $mes . '-' . substr(strval($fecha_actual->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $pago_exento->id;
                $pago_exento->save();
                $pago = new Pago;
                $pago->monto_total = $recibo->saldo;
                $pago->concepto = "Exoneracion de" . ' ' . $recibo->numero;
                $pago->origen = 'Exonerado';
                $pago->numero_pago = $pago_exento->pago_exento;
                $pago->recibo_id = $recibo->id;
                $pago->pago = '';
                $pago->save();
                $pago->pago = 'E-' . $mes . '-' . substr(strval($fecha_actual->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $pago->id;
                $pago->save();
                $recibo->saldo = 0;
                $recibo->exento = true;
                $recibo->save();
                $log = new Log();
                $log->register($log, 'C', 'Exoneración de consumo ' . $recibo->numero . ' a ' . $cliente->nombres . ' ' . $cliente->apellidos, $pago_exento->id, "pago_exentos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            }
            session()->flash('message', 'Exoneracón de consumos completada');
        } else {
            session()->flash('warning', 'Debe seleccionar uno o mas consumos');
            return redirect()->route('recibo.exonera', ['cliente' => $cliente->id]);
        }
        return redirect()->route('recibo.recibo-cliente');
    }

    public function exonera_reverso(Cliente $cliente)
    {
        $recibos = Recibo::where('cliente_id', $cliente->id)->orderBy('fecha', 'desc')->get();
        $array_pagos = [];
        foreach ($recibos as $recibo) {
            $pagos = Pago::where('recibo_id', $recibo->id)->where('origen', 'Exonerado')->get();
            foreach ($pagos as $pago) {
                $fecha = date("d-m-Y", strtotime($pago->created_at));
                array_push($array_pagos, ['recibo_id' => $pago->recibo_id, 'pago_id' => $pago->id, 'fecha' => $fecha, "concepto" => $pago->concepto, "num_referencia" => $pago->pago, "monto_total" => $pago->monto_total]);
            }
        }
        // dd(count($array_pagos));
        return view('admin.recibo.exonera_reverso', compact('cliente', 'recibos', 'array_pagos'));
    }

    public function store_exonera_reverso(Request $request, Cliente $cliente)
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
        $pago_id = $request->get('pago_id');
        // dd($pago_id);
        if ($pago_id != null) {
            foreach ($pago_id as $p) {
                $pago = Pago::find((int)$p);
                $recibo = Recibo::where('id', $pago->recibo_id)->first();
                // dd($recibo);
                // dd($pago_p);
                $pago_exento = PagoExento::where('pago_exento', $pago->numero_pago)->first();
                $pago_exento->delete();
                $saldo = $recibo->saldo + $pago->monto_total;
                $recibo->saldo = $saldo;
                $recibo->exento = false;
                $recibo->update();
                $pago->delete();
                $log = new Log();
                $log->register($log, 'C', 'Reverso de exoneración de consumo ' . $recibo->numero . ' a ' . $cliente->nombres . ' ' . $cliente->apellidos, $pago_exento->id, "pago_exentos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            }
            session()->flash('message', 'Reverso de exoneracón de consumos completada');
        } else {
            session()->flash('warning', 'Debe seleccionar uno o mas recibos');
            return redirect()->route('recibo.exonera', ['cliente' => $cliente->id]);
        }
        return redirect()->route('recibo.recibo-cliente');
    }


    public function create_debito(Cliente $cliente)
    {
        $divisas = Divisa::orderBy('divisa', 'asc')->get();
        return view('admin.recibo.debito', compact('cliente', 'divisas'));
    }


    public function store_debito(Request $request, Cliente $cliente)
    {
        $concepto = $request->get('concepto');
        $monto = (float)$request->get('monto');
        $divisa_id = (int)$request->get('divisa_id');
        /* $nota = $request->get("nota");

        if ($nota == null) {
            session()->flash('error', 'Debe seleccionar entre Cŕedito o Débito');
            return redirect()->route('recibo.create-debito', ['cliente' => $cliente->id]);
        } */

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
        $fecha = Carbon::now();
        $divisa = Divisa::where('id', $divisa_id)->first();
        $recibo = new Recibo;
        $recibo->numero = '0';
        $recibo->fecha = date("Y-m-d", strtotime($fecha_actual));
        $recibo->fecha_vencimiento = date("Y-m-d", strtotime($fecha_actual));
        $recibo->concepto = $concepto;
        /* if ($nota == 'credito') {
            $recibo->monto_divisa = $monto * -1;
            $recibo->monto_bs = ($monto * $divisa->tasa) * -1;
            $recibo->monto_divisa_impuestos = ($monto * $divisa->tasa) * -1;
            $recibo->saldo = ($monto * $divisa->tasa) * -1;
        } else {
        } */
        $recibo->monto_divisa = $monto;
        $recibo->saldo = $monto;

        $recibo->divisa_id = $divisa->id;
        $recibo->cliente_id = $cliente->id;
        $recibo->save();
        /* if ($nota == 'credito') {
            $recibo->numero = 'C-' . $mes . '-' . substr(strval($fecha->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $recibo->id;
        } else {
        } */
        $recibo->numero = 'D-' . $mes . '-' . substr(strval($fecha->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $recibo->id;
        $recibo->save();
        $log = new Log();
        $log->register($log, 'C', 'Registro de nota de débito' . ' por ' . $recibo->concepto . ' a ' . $cliente->nombres . ' ' . $cliente->apellidos, $recibo->id, "recibos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Nota registrada correctamente');
        return redirect()->route('recibo.recibo-cliente');
    }


    public function create_credito(Cliente $cliente)
    {
        // $divisas = Divisa::orderBy('divisa', 'asc')->get();
        $recibos = Recibo::where('cliente_id', $cliente->id)->where('saldo', '>', 0)->get();
        return view('admin.recibo.credito', compact('cliente', 'recibos'));
    }


    public function store_credito(Request $request, Cliente $cliente)
    {
        $concepto = $request->get('concepto');
        $monto = (float)$request->get('monto');
        $recibo_id = (int)$request->get('recibo_id');
        $recibo = Recibo::where('id', $recibo_id)->first();
        if ($monto > $recibo->saldo) {
            session()->flash('error', 'El monto de la nota de crédito no puede ser mayor al saldo del consumo');
            return redirect()->route('recibo.create-credito', ['cliente' => $cliente->id]);
        }
        /* $nota = $request->get("nota");

        if ($nota == null) {
            session()->flash('error', 'Debe seleccionar entre Cŕedito o Débito');
            return redirect()->route('recibo.create-credito', ['cliente' => $cliente->id]);
        } */

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
        $fecha = Carbon::now();
        /* $divisa = Divisa::where('id', $divisa_id)->first(); */
        /* $recibo = new Recibo;
        $recibo->numero = '0';
        $recibo->fecha = date("Y-m-d", strtotime($fecha_actual));
        $recibo->fecha_vencimiento = date("Y-m-d", strtotime($fecha_actual));
        $recibo->concepto = $concepto; */
        //
        /* $recibo->monto_divisa = $monto * -1;
        $recibo->monto_bs = ($monto * $divisa->tasa) * -1;
        $recibo->monto_divisa_impuestos = ($monto * $divisa->tasa) * -1;
        $recibo->saldo = ($monto * $divisa->tasa) * -1; */
        /*  if ($nota == 'credito') {
        } else {
            $recibo->monto_divisa = $monto;
            $recibo->monto_bs = $monto * $divisa->tasa;
            $recibo->monto_divisa_impuestos = $monto * $divisa->tasa;
            $recibo->saldo = $monto * $divisa->tasa;
        } */
        /* $recibo->tasa = $divisa->tasa;
        $recibo->divisa_id = $divisa->id;
        $recibo->cliente_id = $cliente->id;
        $recibo->save();
        $recibo->numero = 'C-' . $mes . '-' . substr(strval($fecha->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $recibo->id; */
        /* if ($nota == 'credito') {
        } else {
            $recibo->numero = 'D-' . $mes . '-' . substr(strval($fecha->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $recibo->id;
        } */
        $recibo->saldo -= $monto;
        $recibo->save();
        $pago = new Pago;
        $pago->pago = '';
        $pago->origen = 'N/C';
        $pago->numero_pago = 'N/C';
        $pago->monto_total = $monto;
        $pago->concepto = $concepto;
        $pago->recibo_id = $recibo->id;
        $pago->save();
        $pago->pago = 'C-' . $mes . '-' . substr(strval($fecha_actual->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $pago->id;
        $pago->save();
        $log = new Log();
        $log->register($log, 'C', 'Registro de nota de crédito' . ' por ' . $recibo->concepto . ' a ' . $cliente->nombres . ' ' . $cliente->apellidos, $recibo->id, "recibos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Nota de crédito registrada correctamente');
        return redirect()->route('recibo.recibo-cliente');
    }
}