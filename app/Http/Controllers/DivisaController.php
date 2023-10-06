<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisaRequest;
use App\Http\Requests\UpdateDivisaRequest;
use App\Http\Requests\UpdateTasaCambioRequest;
use App\Models\Divisa;
use App\Models\Log;

class DivisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.divisa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisa = new Divisa();
        return view('admin.divisa.form', compact('divisa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDivisaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDivisaRequest $request)
    {
        $divisa = new Divisa();
        $divisa->divisa = $request->get('divisa');
        $divisa->descripcion = $request->get('descripcion');
        $divisa->simbolo = $request->get('simbolo');
        $divisa->tasa = 0;
        $divisa->save();
        $log = new Log();
        $log->register($log, 'C', $divisa->divisa, $divisa->id, "divisas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Divisa creada');
        return redirect()->route('divisa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Divisa  $divisa
     * @return \Illuminate\Http\Response
     */
    public function show(Divisa $divisa)
    {
        return view('admin.divisa.show', compact('divisa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divisa  $divisa
     * @return \Illuminate\Http\Response
     */
    public function edit(Divisa $divisa)
    {
        return view('admin.divisa.form', compact('divisa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDivisaRequest  $request
     * @param  \App\Models\Divisa  $divisa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDivisaRequest $request, Divisa $divisa)
    {
        $divisa->divisa = $request->get('divisa');
        $divisa->descripcion = $request->get('descripcion');
        $divisa->simbolo = $request->get('simbolo');
        $divisa->update();
        $log = new Log();
        $log->register($log, 'U', $divisa->divisa, $divisa->id, "divisas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Divisa actualizada');
        return redirect()->route('divisa.index');
    }

    public function show_destroy(Divisa $divisa)
    {
        return view('admin.divisa.show_destroy', compact('divisa'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Divisa  $divisa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Divisa $divisa)
    {
        try {
            $divisa->delete();
            $log = new Log;
            $log->register($log, 'D', $divisa->divisa, $divisa->id, "divisas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Divisa eliminada');
            return redirect()->route('divisa.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar la Divisa, posee información relacionada');
                return redirect()->route('divisa.index');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Divisa  $divisa
     * @return \Illuminate\Http\Response
     */
    public function edit_tasa(Divisa $divisa)
    {
        return view('admin.divisa.form_tasa', compact('divisa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTasaCambioRequest  $request
     * @param  \App\Models\Divisa  $divisa
     * @return \Illuminate\Http\Response
     */
    public function update_tasa(UpdateTasaCambioRequest $request, Divisa $divisa)
    {
        $divisa->tasa = $request->get('tasa');
        $divisa->update();
        $log = new Log();
        $log->register($log, 'U', $divisa->divisa . ' (Cambio de Tasa)', $divisa->id, "divisas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Tasa de cambio actualizada');
        return redirect()->route('divisa.index');
    }
}