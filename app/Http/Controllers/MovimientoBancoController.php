<?php

namespace App\Http\Controllers;

use App\Models\MovimientoBanco;
use Illuminate\Http\Request;
use App\Imports\MovimientoBancoImport;
use App\Http\Requests\StoreMovimientoBancoArchivoRequest;
use App\Models\Banco;
use App\Models\Log;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

class MovimientoBancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bancos = Banco::where('pago_movil', true)->orWhere('transferencia', true)->orderBy('banco', 'asc')->get();
        return view('admin.movimiento_banco.index', compact('bancos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovimientoBanco  $movimientoBanco
     * @return \Illuminate\Http\Response
     */
    public function show(MovimientoBanco $movimientoBanco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MovimientoBanco  $movimientoBanco
     * @return \Illuminate\Http\Response
     */
    public function edit(MovimientoBanco $movimientoBanco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovimientoBanco  $movimientoBanco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovimientoBanco $movimientoBanco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MovimientoBanco  $movimientoBanco
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovimientoBanco $movimientoBanco)
    {
        //
    }

    public function carga_lote()
    {
        return view('admin.movimiento_banco.carga_lote');
    }

    public function procesa_lote(StoreMovimientoBancoArchivoRequest $request)
    {
        if ($request->hasFile('archivo')) {
            if (Storage::exists('archivos')) {
                Storage::delete('archivos/movimiento_bancos.xlsx');
            }

            // dd(file_exists(public_path() . 'almacen/archivos/movimiento_bancos.xlsx'));

            /* if (file_exists(public_path() . 'almacen/archivos/movimiento_bancos.xlsx')) {
                File::delete(public_path() . '/almacen/archivos/movimiento_bancos.xlsx');
            } */

            // File::delete(public_path().'/storage/archivos/*');

            $archivo = $request->file('archivo')->storeAs('/archivos', 'movimiento_bancos.xlsx');

            //dd($archivo);

            try {
                Excel::import(new MovimientoBancoImport, $archivo);
                $log = new Log;
                $log->register($log, 'C', 'Carga por lote', 0, "bancos", auth()->user()->name, auth()->user()->id, auth()->user()->identification);
                session()->flash('message', 'Datos cargados con éxito');
            } catch (\Illuminate\Database\QueryException $e) {
                session()->flash('error', 'Error en la carga del archivo!');
                //dd($e);
            }

            return redirect()->route('movimiento-banco.index');
        } else {
            session()->flash('warning', 'No ha seleccionado el archivo');
            return redirect()->route('movimiento-banco.carga-lote');
        }
    }

    public function index_busca(Request $request)
    {
        $inicio = date('Y-m-d', strtotime($request->get('inicio')));
        $final = date('Y-m-d', strtotime($request->get('final')));
        $banco_id = $request->get('banco_id');

        if ($inicio == null || $final == null) {
            session()->flash('warning', 'Debe señalar la fecha de inicio y la de final');
            return redirect()->route('movimiento-banco.index');
        }

        if ($inicio > $final) {
            session()->flash('warning', 'Fecha de inicio es mayor que fecha final');
            return redirect()->route('movimiento-banco.index');
        }

        return redirect()->route('movimiento-banco.index-lista', ['inicio' => $inicio, 'final' => $final, 'banco_id' => $banco_id]);
    }


    public function index_lista($inicio, $final, $banco_id)
    {
        if ($inicio === $final) {
            $movimiento_bancos = MovimientoBanco::where('banco_id', $banco_id)->where('fecha', $inicio)->paginate(15);
        } else {
            $movimiento_bancos = MovimientoBanco::where('banco_id', $banco_id)->where('fecha', '>=', $inicio)->where('fecha', '<=', $final)->paginate(15);
        }
        $bancos = Banco::where('pago_movil', true)->orWhere('transferencia', true)->orderBy('banco', 'asc')->get();

        return view('admin.movimiento_banco.index_lista', compact('movimiento_bancos', 'bancos'));
    }
}