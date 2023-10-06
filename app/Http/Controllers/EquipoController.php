<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\StoreEquipoArchivoRequest;
use App\Http\Requests\UpdateEquipoRequest;
use App\Models\Equipo;
use App\Models\ModeloEquipo;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;
use App\Imports\EquiposImport;

use Maatwebsite\Excel\Facades\Excel;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.equipo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipo = new Equipo();
        $modelo_equipos = ModeloEquipo::orderBy('modelo_equipo', 'asc')->get();
        return view('admin.equipo.form', compact('equipo', 'modelo_equipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEquipoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEquipoRequest $request)
    {
        $codigo = hash('sha256', (string)$request->get('pon'));
        $cc = Equipo::where('codigo', $codigo)->get();
        if ($cc->count()) {
            session()->flash('error', 'PON ' . (string)$request->get('pon') . ' ya está registrado');
            return redirect()->route('equipo.create');
        }

        $equipo = new Equipo();
        $equipo->serial = $request->get('serial');
        $equipo->pon = $request->get('pon');
        $equipo->codigo = $codigo;
        $equipo->usuario = $request->get('usuario');
        $equipo->password = $request->get('password');
        $equipo->modelo_equipo_id = $request->get('modelo_equipo_id');
        $equipo->save();
        $log = new Log();
        $log->register($log, 'C', $equipo->equipo, $equipo->id, "equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Equipo creado');
        return redirect()->route('equipo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        return view('admin.equipo.show', compact('equipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipo $equipo)
    {
        $modelo_equipos = ModeloEquipo::orderBy('modelo_equipo', 'asc')->get();
        return view('admin.equipo.form', compact('equipo', 'modelo_equipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEquipoRequest  $request
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEquipoRequest $request, Equipo $equipo)
    {
        $pon = $request->get('pon');
        if ($equipo->cedula != $request->get('pon')) {
            $cc = Equipo::where('pon', $pon)->get();
            if ($cc->count()) {
                session()->flash('error', 'PON ' . (string)$request->get('pon') . ' ya está registrado');
                return redirect()->route('equipo.index');
            } else {
                $equipo->pon = $request->get('pon');
                $equipo->codigo = hash('sha256', (string)$request->get('pon'));
            }
        }
        $equipo->serial = $request->get('serial');
        $equipo->usuario = $request->get('usuario');
        $equipo->password = $request->get('password');
        $equipo->modelo_equipo_id = $request->get('modelo_equipo_id');
        $equipo->update();
        $log = new Log();
        $log->register($log, 'U', $equipo->equipo, $equipo->id, "equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Equipo actualizada');
        return redirect()->route('equipo.index');
    }

    public function show_destroy(Equipo $equipo)
    {
        return view('admin.equipo.show_destroy', compact('equipo'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        try {
            $equipo->delete();
            $log = new Log;
            $log->register($log, 'D', $equipo->equipo, $equipo->id, "equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Equipo eliminada');
            return redirect()->route('equipo.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar la Equipo, posee información relacionada');
                return redirect()->route('equipo.index');
            }
        }
    }

    public function carga_lote()
    {
        return view('admin.equipo.carga_lote');
    }

    public function procesa_lote(StoreEquipoArchivoRequest $request)
    {
        if ($request->hasFile('archivo')) {
            if (Storage::exists('archivos')) {
                Storage::delete('archivos/equipos.csv');
            }
            // File::delete(public_path().'/storage/archivos/*');
            $archivo = $request->file('archivo')->storeAs('/archivos', 'equipos.csv');

            try {
                Excel::import(new EquiposImport, $archivo);
                $log = new Log;
                $log->register($log, 'C', 'Carga por lote', 0, "equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            } catch (\Illuminate\Database\QueryException $e) {
                session()->flash('error', 'Error en la carga del archivo!');
            }

            return redirect()->route('equipo.index');
        } else {
            session()->flash('warning', 'No ha seleccionado el archivo');
            return redirect()->route('equipo.carga-lote');
        }
    }
}
