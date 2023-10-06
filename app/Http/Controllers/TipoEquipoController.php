<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipoEquipoRequest;
use App\Http\Requests\UpdateTipoEquipoRequest;
use App\Models\TipoEquipo;
use App\Models\Log;

class TipoEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tipo_equipo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_equipo = new TipoEquipo();
        return view('admin.tipo_equipo.form', compact('tipo_equipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoEquipoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoEquipoRequest $request)
    {
        $tipo_equipo = new TipoEquipo();
        $tipo_equipo->tipo_equipo = $request->get('tipo_equipo');
        $tipo_equipo->save();
        $log = new Log();
        $log->register($log, 'C', $tipo_equipo->tipo_equipo, $tipo_equipo->id, "tipo_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Tipo de equipo creado');
        return redirect()->route('tipo-equipo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoEquipo  $tipo_equipo
     * @return \Illuminate\Http\Response
     */
    public function show(TipoEquipo $tipo_equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoEquipo  $tipo_equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoEquipo $tipo_equipo)
    {
        return view('admin.tipo_equipo.form', compact('tipo_equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoEquipoRequest  $request
     * @param  \App\Models\TipoEquipo  $tipo_equipo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoEquipoRequest $request, TipoEquipo $tipo_equipo)
    {
        $tipo_equipo->tipo_equipo = $request->get('tipo_equipo');
        $tipo_equipo->update();
        $log = new Log();
        $log->register($log, 'U', $tipo_equipo->tipo_equipo, $tipo_equipo->id, "tipo_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Tipo de equipo actualizado');
        return redirect()->route('tipo-equipo.index');
    }

    public function show_destroy(TipoEquipo $tipo_equipo)
    {
        return view('admin.tipo_equipo.show_destroy', compact('tipo_equipo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoEquipo  $tipo_equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoEquipo $tipo_equipo)
    {
        try {
            $tipo_equipo->delete();
            $log = new Log;
            $log->register($log, 'D', $tipo_equipo->tipo_equipo, $tipo_equipo->id, "tipo_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Tipo de equipo eliminado');
            return redirect()->route('tipo-equipo.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el Tipo de equipo, posee información relacionada');
                return redirect()->route('tipo-equipo.index');
            }
        }
    }
}
