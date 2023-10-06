<?php

namespace App\Exports;

use App\Models\PagoWeb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PagoWebRecibidoExport implements FromCollection, WithHeadings
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

        $pago_web_recibidos = PagoWeb::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
            ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
            ->where('conciliado', false)
            ->where('confirmado', false)
            ->orderBy('pago_web', 'asc')
            ->with('cliente')
            ->with('banco_origen')
            ->with('banco_destino')
            ->get();

        foreach ($pago_web_recibidos as $pago_web_recibido) {
            $pago_web_recibido->imagen_pago = 'N/A';
            $pago_web_recibido->monto = number_format($pago_web_recibido->monto, 2, ',', '.');
            $pago_web_recibido->tasa = number_format($pago_web_recibido->tasa, 2, ',', '.');
            $pago_web_recibido->cliente_id = $pago_web_recibido->cliente->nombres . ' ' . $pago_web_recibido->cliente-> apellidos . ' ' . $pago_web_recibido->cliente->cedula;
            $pago_web_recibido->banco_origen_id = $pago_web_recibido->banco_origen->banco;
            $pago_web_recibido->banco_destino_id = $pago_web_recibido->banco_destino->banco;
            $pago_web_recibido->fecha = date('m-d-Y', strtotime($pago_web_recibido->fecha));
        }

        return $pago_web_recibidos;
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
