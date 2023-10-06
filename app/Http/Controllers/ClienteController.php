<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteArchivoRequest;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Zona;
use App\Models\Plan;
use App\Models\Log;
use App\Imports\ClientesImport;
use App\Models\Equipo;
use App\Models\Recibo;
use App\Models\Pago;
use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cliente.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = new Cliente();
        $zonas = Zona::orderBy('zona', 'asc')->get();
        $planes = Plan::orderBy('plan', 'asc')->get();
        $equipos = Equipo::orderBy('pon', 'asc')->get();
        return view('admin.cliente.form', compact('cliente', 'zonas', 'planes', 'equipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClienteRequest $request)
    {
        $codigo = hash('sha256', (string)$request->get('cedula'));
        $cc = Cliente::where('codigo', $codigo)->get();
        if ($cc->count()) {
            session()->flash('error', 'Cédula ' . (string)$request->get('cedula') . ' ya está registrada');
            return redirect()->route('cliente.create');
        }

        $cliente = new Cliente();
        $cliente->nombres = $request->get('nombres');
        $cliente->apellidos = $request->get('apellidos');
        $cliente->direccion = $request->get('direccion');
        $cliente->cedula = $request->get('cedula');
        $cliente->codigo = $codigo;
        $cliente->email = $request->get('email');
        $cliente->telefono_fijo = $request->get('telefono_fijo');
        $cliente->telefono_celular = $request->get('telefono_celular');
        $cliente->fecha_instalacion = date("Y-m-d", strtotime($request->get('fecha_instalacion')));
        // $cliente->fecha_instalacion = strtotime($request->get('fecha_instalacion'));
        if ($request->hasFile('foto')) {
            $nombre = Str::random(10) . str_replace(' ', '', $request->file('foto')->getClientOriginalName());
            $ruta_foto = 'storage/fotos/' . $nombre;
            $img = Image::make($request->file('foto'))
                ->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($ruta_foto);
            $cliente->foto = $ruta_foto;
        } else {
            $cliente->foto = '';
        }
        if ($request->hasFile('imagen_cedula')) {
            $nombre = Str::random(10) . str_replace(' ', '', $request->file('imagen_cedula')->getClientOriginalName());
            $ruta_imagen_cedula = 'storage/cedulas/' . $nombre;
            $img = Image::make($request->file('imagen_cedula'))
                ->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($ruta_imagen_cedula);
            $cliente->imagen_cedula = $ruta_imagen_cedula;
        } else {
            $cliente->imagen_cedula = '';
        }
        // $cliente->cliente = $request->get('otro');
        $cliente->activo = (bool)$request->get('activo');
        $cliente->olt = $request->get('olt');
        $cliente->tarjeta = $request->get('tarjeta');
        $cliente->puerto = $request->get('puerto');
        $cliente->zona_id = $request->get('zona_id');
        $cliente->plan_id = $request->get('plan_id');
        $cliente->save();
        $log = new Log();
        $log->register($log, 'C', $cliente->apelllidos . ', ' . $cliente->nombres . ', ' . $cliente->cedula, $cliente->id, "clientes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Cliente creado(a)');
        return redirect()->route('cliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('admin.cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        $zonas = Zona::orderBy('zona', 'asc')->get();
        $planes = Plan::orderBy('plan', 'asc')->get();
        $equipos = Equipo::orderBy('pon', 'asc')->get();
        return view('admin.cliente.form', compact('cliente', 'zonas', 'planes', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cedula = $request->get('cedula');
        if ($cliente->cedula != $request->get('cedula')) {
            $cc = Cliente::where('cedula', $cedula)->get();
            if ($cc->count()) {
                session()->flash('error', 'Cédula ' . (string)$request->get('cedula') . ' ya está registrada');
                return redirect()->route('cliente.index');
            } else {
                $cliente->cedula = $request->get('cedula');
                $cliente->codigo = hash('sha256', (string)$request->get('cedula'));
            }
        }

        $cliente->nombres = $request->get('nombres');
        $cliente->apellidos = $request->get('apellidos');
        $cliente->direccion = $request->get('direccion');


        $cliente->email = $request->get('email');
        $cliente->telefono_fijo = $request->get('telefono_fijo');
        $cliente->telefono_celular = $request->get('telefono_celular');
        // $cliente->fecha_instalacion = date_format($request->get('fecha_instalacion'), 'Y/m/d');
        $cliente->fecha_instalacion = date("Y-m-d", strtotime($request->get('fecha_instalacion')));
        if ($request->hasFile('foto')) {
            if (File::exists($cliente->foto)) {
                File::delete($cliente->foto);
            }
            $nombre = Str::random(10) . str_replace(' ', '', $request->file('foto')->getClientOriginalName());
            $ruta_foto = 'storage/fotos/' . $nombre;
            $img = Image::make($request->file('foto'))
                ->resize(250, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($ruta_foto);
            $cliente->foto = $ruta_foto;
        }
        if ($request->hasFile('imagen_cedula')) {
            if (File::exists($cliente->imagen_cedula)) {
                File::delete($cliente->imagen_cedula);
            }
            $nombre = Str::random(10) . str_replace(' ', '', $request->file('imagen_cedula')->getClientOriginalName());
            $ruta_imagen_cedula = 'storage/cedulas/' . $nombre;
            $img = Image::make($request->file('imagen_cedula'))
                ->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($ruta_imagen_cedula);
            $cliente->imagen_cedula = $ruta_imagen_cedula;
        }

        //$cliente->cliente = $request->get('otro');
        $cliente->activo = (bool)$request->get('activo');
        $cliente->olt = $request->get('olt');
        $cliente->tarjeta = $request->get('tarjeta');
        $cliente->puerto = $request->get('puerto');
        $cliente->zona_id = $request->get('zona_id');
        $cliente->plan_id = $request->get('plan_id');
        $cliente->update();
        $log = new Log();
        $log->register($log, 'U', $cliente->apelllidos . ', ' . $cliente->nombres . ', ' . $cliente->cedula, $cliente->id, "clientes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        session()->flash('message', 'Cliente actualizado(a)');
        return redirect()->route('cliente.index');
    }

    public function show_destroy(Cliente $cliente)
    {
        return view('admin.cliente.show_destroy', compact('cliente'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            $log = new Log;
            $log->register($log, 'D', $cliente->apelllidos . ', ' . $cliente->nombres . ', ' . $cliente->cedula, $cliente->id, "clientes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Cliente eliminado(a)');
            if (File::exists($cliente->foto)) {
                File::delete($cliente->foto);
            }
            if (File::exists($cliente->imagen_cedula)) {
                File::delete($cliente->imagen_cedula);
            }
            return redirect()->route('cliente.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', 'No es posible eliminar el(la) Cliente, posee información relacionada');
                return redirect()->route('cliente.index');
            }
        }
    }

    public function carga_lote()
    {
        return view('admin.cliente.carga_lote');
    }

    public function procesa_lote(StoreClienteArchivoRequest $request)
    {
        if ($request->hasFile('archivo')) {
            if (Storage::exists('archivos')) {
                Storage::delete('archivos/clientes.csv');
            }
            // File::delete(public_path().'/storage/archivos/*');
            $archivo = $request->file('archivo')->storeAs('/archivos', 'clientes.csv');

            try {
                Excel::import(new ClientesImport, $archivo);
                $log = new Log;
                $log->register($log, 'C', 'Carga por lote', 0, "clientes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
                session()->flash('message', 'Lote cargado con éxito');
            } catch (\Illuminate\Database\QueryException $e) {
                session()->flash('error', 'Error en la carga del archivo!');
            }

            return redirect()->route('cliente.index');
        } else {
            session()->flash('warning', 'No ha seleccionado el archivo');
            return redirect()->route('cliente.carga-lote');
        }
    }

    public function equipo(Cliente $cliente)
    {
        $equipos = Equipo::orderBy('modelo_equipo_id', 'asc')->where('asignado', false)->get();
        return view('admin.cliente.equipo', compact('cliente', 'equipos'));
    }

    public function store_equipo(Request $request, Cliente $cliente)
    {
        if ($request->get('equipo_id') != null && $request->get('equipo_id') != "null") {
            if ($cliente->equipo_id != null) {
                $equipo = Equipo::where('id', $cliente->equipo_id)->first();
                $equipo->asignado = false;
                $equipo->update();
                $log = new Log();
                $log->register($log, 'U', $equipo->modelo_equipo->modelo_equipo . ', PON: ' . $equipo->pon . ', SERIAL: ' . $equipo->serial . ' (Des-asignado)', $equipo->id, "equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            }
            $cliente->equipo_id = $request->get('equipo_id');
            $equipo = Equipo::where('id', $cliente->equipo_id)->first();
            $equipo->asignado = true;
            $cliente->update();
            $log = new Log();
            $log->register($log, 'U', $cliente->apelllidos . ', ' . $cliente->nombres . ', ' . $cliente->cedula . '(Asignar equipo)', $cliente->id, "clientes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Cliente actualizado(a)');
            $equipo->update();
            $log = new Log();
            $log->register($log, 'U', $equipo->modelo_equipo->modelo_equipo . ', PON: ' . $equipo->pon . ', SERIAL: ' . $equipo->cedula . ' (Asignado)', $equipo->id, "equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Equipo asignado');
        } else if ($request->get('equipo_id') == "null") {
            $equipo = Equipo::where('id', $cliente->equipo_id)->first();
            $equipo->asignado = false;
            $cliente->equipo_id = null;
            $cliente->update();
            $log = new Log;
            $log->register($log, 'U', $cliente->apelllidos . ', ' . $cliente->nombres . ', ' . $cliente->cedula . '(Asignar equipo)', $cliente->id, "clientes", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
            session()->flash('message', 'Cliente actualizado(a)');
            $equipo->update();
            $log = new Log();
            $log->register($log, 'U', $equipo->modelo_equipo->modelo_equipo . ', PON: ' . $equipo->pon . ', SERIAL: ' . $equipo->cedula . ' (Des-asignado)', $equipo->id, "equipos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
        }
        return redirect()->route('cliente.index');
    }

    public function cuenta(Cliente $cliente)
    {
        $recibos = Recibo::where('cliente_id', $cliente->id)->orderBy('created_at', 'desc')->get();
        $array_pagos = [];
        foreach ($recibos as $recibo) {
            $pagos = Pago::where('recibo_id', $recibo->id)->get();
            foreach ($pagos as $pago) {
                $fecha = date("d-m-Y", strtotime($pago->created_at));
                array_push($array_pagos, ['recibo_id' => $recibo->id, 'fecha' => $fecha, "concepto" => $pago->concepto, "num_referencia" => $pago->pago, "monto_total" => $pago->monto_total]);
            }
        }
        // dd($array_pagos);
        return view('admin.cliente.cuenta', compact('cliente', 'recibos', 'array_pagos'));
    }
}