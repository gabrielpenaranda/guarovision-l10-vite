<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PagoWebRequest;
use App\Http\Requests\StorePagoWebRequest;

use App\Models\Cliente;
use App\Models\Recibo;
use App\Models\Banco;
use App\Models\PagoWeb;

use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PagoWebController extends Controller
{
    public function index()
    {
        $bancos = Banco::all();
        return view('front.pago_web.index', compact('bancos'));
    }

    public function carga_datos(PagoWebRequest $request)
    {
        $tipo = $request->get('tipo');
        $cedula = $request->get('cedula');
        $cedula_completa = $tipo . '-' . $cedula;
        $cliente = Cliente::where('cedula', $cedula_completa)->first();
        if ($cliente == null) {
            session()->flash('error', 'La cédula introducida no está registrada');
            return redirect()->route('pago-web.index');
        }

        return view('front.pago_web.carga_datos', compact('cliente'));
    }

    public function gracias()
    {
        return view('front.pago_web.gracias');
    }

    public function procesa_pago(StorePagoWebRequest $request, Cliente $cliente)
    {
        $pago_web = new PagoWeb;

        $fecha_actual = Carbon::now();
        switch ($fecha_actual->month) {
            case 1:
                $mes = 'ENE';
                $mes_largo = 'ENERO';
                break;
            case 2:
                $mes = 'FEB';
                $mes_largo = 'FEBRERO';
                break;
            case 3:
                $mes = 'MAR';
                $mes_largo = 'MARZO';
                break;
            case 4:
                $mes = 'ABR';
                $mes_largo = 'ABRIL';
                break;
            case 5:
                $mes = 'MAY';
                $mes_largo = 'MAYO';
                break;
            case 6:
                $mes = 'JUN';
                $mes_largo = 'JUNIO';
                break;
            case 7:
                $mes = 'JUL';
                $mes_largo = 'JULIO';
                break;
            case 8:
                $mes = 'AGO';
                $mes_largo = 'AGOSTO';
                break;
            case 9:
                $mes = 'SEP';
                $mes_largo = 'SEPTIEMBRE';
                break;
            case 10:
                $mes = 'OCT';
                $mes_largo = 'OCTUBRE';
                break;
            case 11:
                $mes = 'NOV';
                $mes_largo = 'NOVIEMBRE';
                break;
            case 12:
                $mes = 'DIC';
                $mes_largo = 'DICIEMBRE';
                break;
        }

        $tipo = $request->get('tipo_pago');
        if ($tipo == 'pago_movil') {
            $tipo_pago = 'M';
        } else {
            $tipo_pago = 'T';
        }

        $pago_web->realizado_por = $request->get('realizado_por');
        $pago_web->cedula = $request->get('cedula');
        $pago_web->telefono_celular = $request->get('telefono_celular');
        $pago_web->monto = $request->get('monto');
        $pago_web->num_referencia = $request->get('num_referencia');
        $pago_web->tipo_pago = $tipo_pago;
        $pago_web->banco_origen_id = $request->get('banco_origen_id');
        $pago_web->banco_destino_id = $request->get('banco_destino_id');
        $pago_web->cliente_id = $cliente->id;
        $pago_web->fecha = Carbon::now()->format('Y/m/d');
        $pago_web->conciliado = false;
        $pago_web->confirmado = false;

        if ($request->hasFile('imagen_pago')) {
            $nombre = Str::random(10) . str_replace(' ', '', $request->file('num_referencia')) . $request->file('imagen_pago')->getClientOriginalExtension();
            $ruta_imagen = 'storage/imagenes_pagos_web/' . $nombre;
            $img = Image::make($request->file('imagen_pago'))
                ->resize(350, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($ruta_imagen);
            $pago_web->imagen_pago = $ruta_imagen;
        } else {
            $pago_web->imagen_pago = '';
        }
        $pago_web->save();

        $pago_web->pago_web = 'W-' . $mes . '-' . substr(strval($fecha_actual->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $cliente->id, -4) . '-' . $pago_web->id;
        $pago_web->save();

        return redirect()->route('pago-web.gracias');
    }

    public function cuenta(Cliente $cliente)
    {

        return view('front.pago_web.cuenta', compact('cliente'));
    }
}