<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConceptoRequest;
use App\Http\Requests\UpdateConceptoRequest;
use Illuminate\Http\Request;
use App\Models\Concepto;
use App\Models\Divisa;
use App\Models\Impuesto;
use App\Models\Log;

class ConceptoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.concepto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $concepto = new Concepto();
        $divisas = Divisa::orderBy('divisa', 'asc')->get();
        return view('admin.concepto.form', compact('concepto', 'divisas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreConceptoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConceptoRequest $request)
    {
        $concepto = new Concepto();
        $concepto->concepto = $request->get('concepto');
        $concepto->descripcion = $request->get('descripcion');
        $concepto->tarifa = $request->get('tarifa');
        // $concepto->cantidad = (bool)$request->get('cantidad');
        $concepto->divisa_id = $request->get('divisa_id');
        $concepto->save();
        $log = new Log();
        $log->register($log, 'C', $concepto->concepto, $concepto->id, "conceptos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Concepto creada');
        return redirect()->route('concepto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Concepto  $concepto
     * @return \Illuminate\Http\Response
     */
    public function show(Concepto $concepto)
    {
        return view('admin.concepto.show', compact('concepto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Concepto  $concepto
     * @return \Illuminate\Http\Response
     */
    public function edit(Concepto $concepto)
    {
        $divisas = Divisa::orderBy('divisa', 'asc')->get();
        return view('admin.concepto.form', compact('concepto', 'divisas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateConceptoRequest  $request
     * @param  \App\Models\Concepto  $concepto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConceptoRequest $request, Concepto $concepto)
    {
        $concepto->descripcion = $request->get('descripcion');
        $concepto->tarifa = $request->get('tarifa');
        // $concepto->cantidad = (bool)$request->get('cantidad');
        $concepto->divisa_id = $request->get('divisa_id');
        $concepto->update();
        $log = new Log();
        $log->register($log, 'U', $concepto->concepto, $concepto->id, "conceptos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Concepto actualizada');
        return redirect()->route('concepto.index');
    }

    public function show_destroy(Concepto $concepto)
    {
        return view('admin.concepto.show_destroy', compact('concepto'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Concepto  $concepto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Concepto $concepto)
    {
        try {
            $concepto->delete();
            $log = new Log;
            $log->register($log, 'D', $concepto->concepto, $concepto->id, "conceptos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Concepto eliminada');
            return redirect()->route('concepto.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar la Concepto, posee información relacionada');
                return redirect()->route('concepto.index');
            }
        }
    }

    public function impuesto(Concepto $concepto)
    {
        $impuestos = Impuesto::where('es_activo', true)->orderBy('impuesto', 'asc')->get();
        return view('admin.concepto.impuesto', compact('concepto', 'impuestos'));
    }

    public function store_impuesto(Request $request, Concepto $concepto)
    {
        $impuesto = $request->get('impuesto');
        if ($impuesto != null) {
            $concepto->impuestos()->sync($impuesto);
            session()->flash('message', 'Impuestos asignados');
        } else {
            session()->flash('warning', 'No seleccionó ningun impuesto');
        }

        return redirect()->route('concepto.index');
    }
}
