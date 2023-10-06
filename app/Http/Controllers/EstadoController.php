<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstadoRequest;
use App\Http\Requests\UpdateEstadoRequest;
use App\Models\Estado;
use App\Models\Log;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$estados = Estado::orderBy('estado', 'asc')->paginate(8);
        return view('admin.estado.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estado = new Estado();
        return view('admin.estado.form', compact('estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEstadoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstadoRequest $request)
    {
        $estado = new Estado();
        $estado->estado = $request->get('estado');
        $estado->save();
        $log = new Log();
        $log->register($log, 'C', $estado->estado, $estado->id, "estados", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Estado creado');
        return redirect()->route('estado.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Estado $estado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        return view('admin.estado.form', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEstadoRequest  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstadoRequest $request, Estado $estado)
    {
        $estado->estado = $request->get('estado');
        $estado->update();
        $log = new Log();
        $log->register($log, 'U', $estado->estado, $estado->id, "estados", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Estado actualizado');
        return redirect()->route('estado.index');
    }

    public function show_destroy(Estado $estado)
    {
        return view('admin.estado.show_destroy', compact('estado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estado $estado)
    {
        try {
            $estado->delete();
            $log = new Log;
            $log->register($log, 'D', $estado->estado, $estado->id, "estados", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Estado eliminado');
            return redirect()->route('estado.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el Estado, posee información relacionada');
                return redirect()->route('estado.index');
            }
        }
    }
}
