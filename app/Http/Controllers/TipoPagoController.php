<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoPagoRequest;
use App\Http\Requests\UpdateTipoPagoRequest;
use App\Models\TipoPago;
use App\Models\Log;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo_pagos = TipoPago::orderBy('tipo_pago', 'asc')->paginate(8);
        $titulo = 'Tipos de Pago';
        return view('admin.tipo_pago.index', compact('tipo_pagos', 'titulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_pago = new TipoPago();
        $titulo = 'Crear TipoPago';
        return view('admin.tipo_pago.create', compact('tipo_pago', 'titulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoPagoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoPagoRequest $request)
    {
        $tipo_pago = new TipoPago();
        $tipo_pago->tipo_pago = $request->get('tipo_pago');
        $tipo_pago->es_remoto = $request->get('es_remoto');
        $tipo_pago->es_taquilla = $request->get('es_taquilla');
        $tipo_pago->save();
        $log = new Log();
        $log->register($log, 'C', $tipo_pago->tipo_pago, $tipo_pago->id, "tipo_pagos", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Tipo de Pago creado');
        return redirect()->route('tipo_pago.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoPago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function show(TipoPago $tipo_pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoPago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoPago $tipo_pago)
    {
        $titulo = 'Editar Tipo de Pago';
        return view('admin.tipo_pago.create', compact('tipo_pago', 'titulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoPagoRequest  $request
     * @param  \App\Models\TipoPago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoPagoRequest $request, TipoPago $tipo_pago)
    {
        $tipo_pago->tipo_pago = $request->get('tipo_pago');
        $tipo_pago->es_remoto = $request->get('es_remoto');
        $tipo_pago->es_taquilla = $request->get('es_taquilla');
        $tipo_pago->update();
        $log = new Log();
        $log->register($log, 'U', $tipo_pago->tipo_pago, $tipo_pago->id, "tipo_pagos", auth()->user()->name, auth()->user()->identification);
        session()->flash('message', 'Tipo de Pago actualizado');
        return redirect()->route('tipo_pago.index');
    }

    public function show_destroy(TipoPago $tipo_pago)
    {
        $titulo = 'Eliminar Tipo de Pago';
        return view('admin.tipo_pago.show_destroy', compact('tipo_pago', 'titulo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoPago  $tipo_pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoPago $tipo_pago)
    {
        try {
            $tipo_pago->delete();
            $log = new Log;
            $log->register($log, 'D', $tipo_pago->name, $tipo_pago->id, 'tipo_pagos', auth()->user()->name, auth()->user()->identification);
            session()->flash('message', 'Tipo de Pago eliminado');
            return redirect()->route('tipo_pago.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el Tipo de Pago, posee información relacionada');
                return redirect()->route('tipo_pago.index');
            }
        }
    }
}
