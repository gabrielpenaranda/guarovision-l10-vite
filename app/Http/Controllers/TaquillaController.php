<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaquillaRequest;
use App\Http\Requests\UpdateTaquillaRequest;
use App\Models\Taquilla;
use App\Models\Ciudad;
use App\Models\Log;

class TaquillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.taquilla.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taquilla = new Taquilla();
        $ciudades = Ciudad::orderBy('ciudad', 'asc')->get();
        return view('admin.taquilla.form', compact('taquilla', 'ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaquillaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaquillaRequest $request)
    {
        $taquilla = new Taquilla();
        $taquilla->taquilla = $request->get('taquilla');
        $taquilla->tipo_taquilla = $request->get('tipo_taquilla');
        $taquilla->direccion = $request->get('direccion');
        $taquilla->ciudad_id = $request->get('ciudad_id');
        $taquilla->save();
        $log = new Log();
        $log->register($log, 'C', $taquilla->taquilla, $taquilla->id, "taquillas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Taquilla creada');
        return redirect()->route('taquilla.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taquilla  $taquilla
     * @return \Illuminate\Http\Response
     */
    public function show(Taquilla $taquilla)
    {
        return view('admin.taquilla.show', compact('taquilla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taquilla  $taquilla
     * @return \Illuminate\Http\Response
     */
    public function edit(Taquilla $taquilla)
    {
        $ciudades = Ciudad::orderBy('ciudad', 'asc')->get();
        return view('admin.taquilla.form', compact('taquilla', 'ciudades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaquillaRequest  $request
     * @param  \App\Models\Taquilla  $taquilla
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaquillaRequest $request, Taquilla $taquilla)
    {
        $taquilla->taquilla = $request->get('taquilla');
        $taquilla->tipo_taquilla = $request->get('tipo_taquilla');
        $taquilla->direccion = $request->get('direccion');
        $taquilla->ciudad_id = $request->get('ciudad_id');
        $taquilla->update();
        $log = new Log();
        $log->register($log, 'U', $taquilla->taquilla, $taquilla->id, "taquillas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Taquilla actualizada');
        return redirect()->route('taquilla.index');
    }

    public function show_destroy(Taquilla $taquilla)
    {
        return view('admin.taquilla.show_destroy', compact('taquilla'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taquilla  $taquilla
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taquilla $taquilla)
    {
        try {
            $taquilla->delete();
            $log = new Log;
            $log->register($log, 'D', $taquilla->taquilla, $taquilla->id, "taquillas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Taquilla eliminada');
            return redirect()->route('taquilla.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar la Taquilla, posee información relacionada');
                return redirect()->route('taquilla.index');
            }
        }
    }
}