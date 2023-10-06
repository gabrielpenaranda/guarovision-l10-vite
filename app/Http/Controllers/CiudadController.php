<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCiudadRequest;
use App\Http\Requests\UpdateCiudadRequest;
use App\Models\Ciudad;
use App\Models\Estado;
use App\Models\Log;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $ciudades = Ciudad::orderBy('ciudad', 'asc')->paginate(8);
        $titulo = 'Ciudades'; */
        return view('admin.ciudad.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciudad = new Ciudad();
        $estados = Estado::orderBy('estado', 'asc')->get();
        return view('admin.ciudad.form', compact('ciudad', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCiudadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCiudadRequest $request)
    {
        $ciudad = new Ciudad();
        $ciudad->ciudad = $request->get('ciudad');
        $ciudad->estado_id = $request->get('estado_id');
        $ciudad->save();
        $log = new Log();
        $log->register($log, 'C', $ciudad->ciudad, $ciudad->id, "ciudades", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Ciudad creada');
        return redirect()->route('ciudad.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function show(Ciudad $ciudad)
    {
        return view('admin.ciudad.show', compact('ciudad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudad $ciudad)
    {
        $estados = Estado::orderBy('estado', 'asc')->get();
        return view('admin.ciudad.form', compact('ciudad', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCiudadRequest  $request
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCiudadRequest $request, Ciudad $ciudad)
    {
        $ciudad->ciudad = $request->get('ciudad');
        $ciudad->estado_id = $request->get('estado_id');
        $ciudad->update();
        $log = new Log();
        $log->register($log, 'U', $ciudad->ciudad, $ciudad->id, "ciudades", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Ciudad actualizada');
        return redirect()->route('ciudad.index');
    }

    public function show_destroy(Ciudad $ciudad)
    {
        return view('admin.ciudad.show_destroy', compact('ciudad'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciudad $ciudad)
    {
        try {
            $ciudad->delete();
            $log = new Log;
            $log->register($log, 'D', $ciudad->ciudad, $ciudad->id, "ciudades", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Ciudad eliminada');
            return redirect()->route('ciudad.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar la Ciudad, posee información relacionada');
                return redirect()->route('ciudad.index');
            }
        }
    }
}
