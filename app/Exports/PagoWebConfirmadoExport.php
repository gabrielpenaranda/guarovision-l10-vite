<?php

namespace App\Exports;

use App\Models\PagoWeb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PagoWebConfirmadoExport implements FromCollection, WithHeadings
{
    public function __construct($desde, $hasta)
    {
        $this->desde = $desde;
        $this->hasta = $hasta;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $inicio = date('Y-m-d', strtotime($this->desde));
        $final = date('Y-m-d', strtotime($this->hasta));

        $pago_web_confirmados = PagoWeb::where('created_at', '>=', $inicio . 'T00:00:00.00000Z')
            ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
            ->where('confirmado', true)
            ->orderBy('pago_web', 'asc')
            ->with('cliente')
            ->with('banco_origen')
            ->with('banco_destino')
            ->get();

        foreach ($pago_web_confirmados as $pago_web_confirmado) {
            $pago_web_confirmado->imagen_pago = 'N/A';
            $pago_web_confirmado->monto = number_format($pago_web_confirmado->monto, 2, ',', '.');
            $pago_web_confirmado->tasa = number_format($pago_web_confirmado->tasa, 2, ',', '.');
            $pago_web_confirmado->cliente_id = $pago_web_confirmado->cliente->nombres . ' ' . $pago_web_confirmado->cliente-> apellidos . ' ' . $pago_web_confirmado->cliente->cedula;
            $pago_web_confirmado->banco_origen_id = $pago_web_confirmado->banco_origen->banco;
            $pago_web_confirmado->banco_destino_id = $pago_web_confirmado->banco_destino->banco;
            $pago_web_confirmado->fecha = date('m-d-Y', strtotime($pago_web_confirmado->fecha));
        }

        return $pago_web_confirmados;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nº Pago',
            'Fecha',
            'Realizado Por',
            'Nº Cedula',
            'Celular',
            'Imagen',
            'Monto',
            'Tasa',
            'Nº Referencia',
            'Tipo Pago',
            'Conciliado',
            'Confirmado',
            'Banco Origen',
            'Banco Destino',
            'Cliente',
            'Observaciones',
            'Fecha Creacion',
            'Fecha Actualizacion',
        ];
    }
}
