<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImpuestoRequest;
use App\Http\Requests\UpdateImpuestoRequest;
use App\Models\Impuesto;
use App\Models\Log;

class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.impuesto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $impuesto = new Impuesto();
        return view('admin.impuesto.form', compact('impuesto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreImpuestoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImpuestoRequest $request)
    {
        $impuesto = new Impuesto();
        $impuesto->impuesto = $request->get('impuesto');
        $impuesto->tasa = $request->get('tasa');
        $impuesto->es_activo = (bool)$request->get('es_activo');
        $impuesto->save();
        $log = new Log();
        $log->register($log, 'C', $impuesto->impuesto, $impuesto->id, "impuestos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Impuesto creado');
        return redirect()->route('impuesto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function show(Impuesto $impuesto)
    {
        return view('admin.impuesto.show', compact('impuesto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Impuesto $impuesto)
    {
        return view('admin.impuesto.form', compact('impuesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateImpuestoRequest  $request
     * @param  \App\Models\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImpuestoRequest $request, Impuesto $impuesto)
    {
        $impuesto->tasa = $request->get('tasa');
        $impuesto->es_activo = (bool)$request->get('es_activo');
        $impuesto->update();
        $log = new Log();
        $log->register($log, 'U', $impuesto->impuesto, $impuesto->id, "impuestos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Impuesto actualizado');
        return redirect()->route('impuesto.index');
    }

    public function show_destroy(Impuesto $impuesto)
    {
        return view('admin.impuesto.show_destroy', compact('impuesto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Impuesto  $impuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impuesto $impuesto)
    {
        try {
            $impuesto->delete();
            $log = new Log;
            $log->register($log, 'D', $impuesto->impuesto, $impuesto->id, "impuestos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Impuesto eliminado');
            return redirect()->route('impuesto.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el Impuesto, posee información relacionada');
                return redirect()->route('impuesto.index');
            }
        }
    }
}
