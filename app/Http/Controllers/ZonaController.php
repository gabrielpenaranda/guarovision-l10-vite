<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreZonaRequest;
use App\Http\Requests\UpdateZonaRequest;
use App\Models\Zona;
use App\Models\Ciudad;
use App\Models\Log;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.zona.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zona = new Zona();
        $ciudades = Ciudad::orderBy('ciudad', 'asc')->get();
        return view('admin.zona.form', compact('zona', 'ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreZonaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreZonaRequest $request)
    {
        $zona = new Zona();
        $zona->zona = $request->get('zona');
        $zona->ciudad_id = $request->get('ciudad_id');
        $zona->save();
        $log = new Log();
        $log->register($log, 'C', $zona->zona, $zona->id, "zonas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Zona creada');
        return redirect()->route('zona.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show(Zona $zona)
    {
        return view('admin.zona.show', compact('zona'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit(Zona $zona)
    {
        $ciudades = Ciudad::orderBy('ciudad', 'asc')->get();
        return view('admin.zona.form', compact('zona', 'ciudades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateZonaRequest  $request
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateZonaRequest $request, Zona $zona)
    {
        $zona->zona = $request->get('zona');
        $zona->ciudad_id = $request->get('ciudad_id');
        $zona->update();
        $log = new Log();
        $log->register($log, 'U', $zona->zona, $zona->id, "zonas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Zona actualizado');
        return redirect()->route('zona.index');
    }

    public function show_destroy(Zona $zona)
    {
        return view('admin.zona.show_destroy', compact('zona'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zona $zona)
    {
        try {
            $zona->delete();
            $log = new Log;
            $log->register($log, 'D', $zona->zona, $zona->id, "zonas", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Zona eliminada');
            return redirect()->route('zona.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar la Zona, posee información relacionada');
                return redirect()->route('zona.index');
            }
        }
    }
}
