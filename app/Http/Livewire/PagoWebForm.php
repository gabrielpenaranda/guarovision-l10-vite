<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recibo;
use App\Models\Banco;
use App\Models\PagoWeb;
use App\Models\Divisa;
use App\Models\Cliente;

use Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

use Livewire\WithFileUploads;
use Symfony\Component\Console\Input\Input;

class PagoWebForm extends Component
{
    use WithFileUploads;

    public $cliente;
    public $t_pago = 'pago_movil';
    public $pago_web = '';
    public $realizado_por = '';
    public $cedula = '';
    public $telefono_celular = '';
    public $imagen_pago;
    public $monto;
    public $num_referencia = '';
    public $tipo_pago = '';
    public $banco_origen_id;
    public $banco_destino_id;
    public $bancos;
    public $bancos_d;
    public $divisa;
    public $observaciones;

    protected $rules = [
        'monto' => "required",
        'num_referencia' => "required",
        'realizado_por' => "required",
        'cedula' => 'required',
        'telefono_celular' => "required|min:9",
        'banco_origen_id' => "required",
        'banco_destino_id' => "required",
    ];

    protected $rules2 = [
        'monto' => "required",
        'num_referencia' => "required",
        'realizado_por' => "required",
        'cedula' => 'required',
        'telefono_celular' => "required|min:9",
        'banco_origen_id' => "required",
        'banco_destino_id' => "required",
        'imagen_pago' => "image|max:2048",
    ];

    protected $messages = [
        'monto.required' => 'El monto es requerido',
        'num_referencia.required' => 'El número de transferencia/pago móvil es requerido',
        'realizado_por.required' => 'El nombre de la persona que realiza el pago es requerido',
        'cedula.required' => 'El número de cédula de quien realiza el pago es requerido',
        'telefono_celular.required' => 'El teléfono celular es requerido',
        'telefono_celular.min' => 'El teléfono celular debe tener mínimo 9 dígitos',
        'banco_origen_id.required' => "Debe seleccionar un banco de origen",
        'banco_destino_id.required' => "Debe seleccionar un banco de destino",
        'imagen_pago.max' => 'El tamaño de archivo no debe ser mayor a 2MB',
    ];


    public function mount(Cliente $cliente)
    {
        $this->cliente = $cliente;
        $this->bancos = Banco::orderBy('banco', 'asc')->get();
        //$this->banco_origen_id = $this->bancos->first()->id;
        $this->bancos_d = Banco::where($this->t_pago, true)->orderBy('banco', 'asc')->get();
        //$this->banco_destino_id = $this->bancos_d->first()->id;
    }

    public function render()
    {
        $recibos = Recibo::where('cliente_id', $this->cliente->id)->where('saldo', '>', 0)->get();
        $this->bancos_d = Banco::where($this->t_pago, true)->orderBy('banco', 'asc')->get();

        $cuenta = 0;
        foreach ($recibos as $recibo) {
            $cuenta += $recibo->saldo;
        }
        $this->divisa = Divisa::first();
        $divisa = $this->divisa;
        $cliente = $this->cliente;
        $bancos_d = $this->bancos_d;
        $bancos = $this->bancos;
        return view('livewire.pago-web-form', compact('cliente', 'recibos', 'cuenta', 'bancos', 'bancos_d', 'divisa'));
    }

    public function procesar_pago()
    {
        // dd($this->imagen_pago);

        if ($this->imagen_pago == null) {
            $this->validate($this->rules);
        } else {
            $this->validate($this->rules2);
        }

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

        if ($this->t_pago == 'pago_movil') {
            $tipo_pago = 'M';
        } else {
            $tipo_pago = 'T';
        }

        if ($this->imagen_pago) {
            $imagen = $this->imagen_pago->store('imagenes_pagos_web');
        }

        if ($this->telefono_celular[0] == 0) {
            $this->telefono_celular = substr($this->telefono_celular, 1);
        }

        $pago_web->realizado_por = $this->realizado_por;
        $pago_web->telefono_celular = $this->telefono_celular;
        $pago_web->monto = $this->monto;
        $pago_web->num_referencia = $this->num_referencia;
        $pago_web->cedula = $this->cedula;
        $pago_web->tipo_pago = $tipo_pago;
        $pago_web->tasa = $this->divisa->tasa;
        $pago_web->banco_origen_id = $this->banco_origen_id;
        $pago_web->banco_destino_id = $this->banco_destino_id;
        $pago_web->cliente_id = $this->cliente->id;
        $pago_web->conciliado = false;
        $pago_web->confirmado = false;
        $pago_web->observaciones = $this->observaciones;
        $pago_web->fecha = Carbon::now()->format('Y/m/d');
        $pago_web->pago_web = '';
        if ($this->imagen_pago) {
            $pago_web->imagen_pago = $imagen;
        }

        $pago_web->save();

        $pago_web->pago_web = 'W-' . $mes . '-' . substr(strval($fecha_actual->year), 2, 2) . '-' . substr(str_repeat(0, 4) . $this->cliente->id, -4) . '-' . $pago_web->id;
        $pago_web->save();

        return redirect()->route('pago-web.gracias');
    }
}