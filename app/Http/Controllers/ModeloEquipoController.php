<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModeloEquipoRequest;
use App\Http\Requests\UpdateModeloEquipoRequest;
use App\Models\ModeloEquipo;
use App\Models\TipoEquipo;
use App\Models\MarcaEquipo;
use App\Models\Log;

class ModeloEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.modelo_equipo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modelo_equipo = new ModeloEquipo();
        $tipo_equipos = TipoEquipo::orderBy('tipo_equipo', 'asc')->get();
        $marca_equipos = MarcaEquipo::orderBy('marca_equipo', 'asc')->get();
        return view('admin.modelo_equipo.form', compact('modelo_equipo', 'tipo_equipos', 'marca_equipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreModeloEquipoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModeloEquipoRequest $request)
    {
        $modelo_equipo = new ModeloEquipo();
        $modelo_equipo->modelo_equipo = $request->get('modelo_equipo');
        $modelo_equipo->tipo_equipo_id = $request->get('tipo_equipo_id');
        $modelo_equipo->marca_equipo_id = $request->get('marca_equipo_id');
        $modelo_equipo->save();
        $log = new Log();
        $log->register($log, 'C', $modelo_equipo->modelo_equipo, $modelo_equipo->id, "modelo_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Modelo de equipo creado');
        return redirect()->route('modelo-equipo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModeloEquipo  $modelo_equipo
     * @return \Illuminate\Http\Response
     */
    public function show(ModeloEquipo $modelo_equipo)
    {
        return view('admin.modelo_equipo.show', compact('modelo_equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModeloEquipo  $modelo_equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(ModeloEquipo $modelo_equipo)
    {
        $tipo_equipos = TipoEquipo::orderBy('tipo_equipo', 'asc')->get();
        $marca_equipos = MarcaEquipo::orderBy('marca_equipo', 'asc')->get();
        return view('admin.modelo_equipo.form', compact('modelo_equipo', 'tipo_equipos', 'marca_equipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateModeloEquipoRequest  $request
     * @param  \App\Models\ModeloEquipo  $modelo_equipo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModeloEquipoRequest $request, ModeloEquipo $modelo_equipo)
    {
        $modelo_equipo->modelo_equipo = $request->get('modelo_equipo');
        $modelo_equipo->tipo_equipo_id = $request->get('tipo_equipo_id');
        $modelo_equipo->marca_equipo_id = $request->get('marca_equipo_id');
        $modelo_equipo->update();
        $log = new Log();
        $log->register($log, 'U', $modelo_equipo->modelo_equipo, $modelo_equipo->id, "modelo_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Modelo de equipo actualizado');
        return redirect()->route('modelo-equipo.index');
    }

    public function show_destroy(ModeloEquipo $modelo_equipo)
    {
        return view('admin.modelo_equipo.show_destroy', compact('modelo_equipo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ModeloEquipo  $modelo_equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModeloEquipo $modelo_equipo)
    {
        try {
            $modelo_equipo->delete();
            $log = new Log;
            $log->register($log, 'D', $modelo_equipo->modelo_equipo, $modelo_equipo->id, "modelo_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Modelo de equipo eliminado');
            return redirect()->route('modelo-equipo.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el modelo de equipo, posee información relacionada');
                return redirect()->route('modelo-equipo.index');
            }
        }
    }
}
