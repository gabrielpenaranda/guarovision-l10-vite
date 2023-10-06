<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcaEquipoRequest;
use App\Http\Requests\UpdateMarcaEquipoRequest;
use App\Models\MarcaEquipo;
use App\Models\Log;

class MarcaEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.marca_equipo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marca_equipo = new MarcaEquipo();
        return view('admin.marca_equipo.form', compact('marca_equipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarcaEquipoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarcaEquipoRequest $request)
    {
        $marca_equipo = new MarcaEquipo();
        $marca_equipo->marca_equipo = $request->get('marca_equipo');
        $marca_equipo->save();
        $log = new Log();
        $log->register($log, 'C', $marca_equipo->marca_equipo, $marca_equipo->id, "marca_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Marca de equipo creada');
        return redirect()->route('marca-equipo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarcaEquipo  $marca_equipo
     * @return \Illuminate\Http\Response
     */
    public function show(MarcaEquipo $marca_equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarcaEquipo  $marca_equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(MarcaEquipo $marca_equipo)
    {
        return view('admin.marca_equipo.form', compact('marca_equipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarcaEquipoRequest  $request
     * @param  \App\Models\MarcaEquipo  $marca_equipo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarcaEquipoRequest $request, MarcaEquipo $marca_equipo)
    {
        $marca_equipo->marca_equipo = $request->get('marca_equipo');
        $marca_equipo->update();
        $log = new Log();
        $log->register($log, 'U', $marca_equipo->marca_equipo, $marca_equipo->id, "marca_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Marca de equipo actualizada');
        return redirect()->route('marca-equipo.index');
    }

    public function show_destroy(MarcaEquipo $marca_equipo)
    {
        return view('admin.marca_equipo.show_destroy', compact('marca_equipo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MarcaEquipo  $marca_equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarcaEquipo $marca_equipo)
    {
        try {
            $marca_equipo->delete();
            $log = new Log;
            $log->register($log, 'D', $marca_equipo->marca_equipo, $marca_equipo->id, "marca_equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Marca de equipo eliminada');
            return redirect()->route('marca-equipo.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar la marca de equipo, posee información relacionada');
                return redirect()->route('marca-equipo.index');
            }
        }
    }
}
