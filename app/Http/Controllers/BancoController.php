<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBancoRequest;
use App\Http\Requests\UpdateBancoRequest;
use App\Models\Banco;
use App\Models\Log;



class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banco.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banco = new Banco();
        return view('admin.banco.form', compact('banco'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBancoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBancoRequest $request)
    {
        $banco = new Banco();
        $banco->codigo = $request->get('codigo');
        $banco->banco = $request->get('banco');
        $banco->pago_movil = (bool)$request->get('pago_movil');
        $banco->transferencia = (bool)$request->get('transferencia');
        $banco->pago_movil_nombre = $request->get('pago_movil_nombre');
        $banco->pago_movil_telefono = $request->get('pago_movil_telefono');
        $banco->pago_movil_rif = $request->get('pago_movil_rif');
        $banco->transferencia_cuenta = $request->get('transferencia_cuenta');
        $banco->transferencia_nombre = $request->get('transferencia_nombre');
        $banco->transferencia_rif = $request->get('transferencia_rif');
        $banco->save();
        $log = new Log();
        $log->register($log, 'C', $banco->banco, $banco->id, "bancos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Banco creado');
        return redirect()->route('banco.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Banco $banco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Banco $banco)
    {
        return view('admin.banco.form', compact('banco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBancoRequest  $request
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBancoRequest $request, Banco $banco)
    {
        $banco->codigo = $request->get('codigo');
        $banco->banco = $request->get('banco');
        $banco->pago_movil = (bool)$request->get('pago_movil');
        $banco->transferencia = (bool)$request->get('transferencia');
        $banco->pago_movil_nombre = $request->get('pago_movil_nombre');
        $banco->pago_movil_telefono = $request->get('pago_movil_telefono');
        $banco->pago_movil_rif = $request->get('pago_movil_rif');
        $banco->transferencia_cuenta = $request->get('transferencia_cuenta');
        $banco->transferencia_nombre = $request->get('transferencia_nombre');
        $banco->transferencia_rif = $request->get('transferencia_rif');
        $banco->update();
        $log = new Log();
        $log->register($log, 'U', $banco->banco, $banco->id, "bancos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Banco actualizado');
        return redirect()->route('banco.index');
    }

    public function show_destroy(Banco $banco)
    {
        return view('admin.banco.show_destroy', compact('banco'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banco $banco)
    {
        try {
            $banco->delete();
            $log = new Log;
            $log->register($log, 'D', $banco->banco, $banco->id, "bancos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Banco eliminado');
            return redirect()->route('banco.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el Banco, posee información relacionada');
                return redirect()->route('banco.index');
            }
        }
    }
}