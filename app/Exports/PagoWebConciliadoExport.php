<?php

namespace App\Exports;

use App\Models\PagoWeb;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PagoWebConciliadoExport implements FromCollection, WithHeadings
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

        $pago_web_conciliados = PagoWeb::where('created_at', '>=', $inicio . 'T00:00:00.00000Z')
            ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
            ->where('conciliado', true)
            ->where('confirmado', false)
            ->orderBy('pago_web', 'asc')
            ->with('cliente')
            ->with('banco_origen')
            ->with('banco_destino')
            ->get();

        foreach ($pago_web_conciliados as $pago_web_conciliado) {
            $pago_web_conciliado->imagen_pago = 'N/A';
            $pago_web_conciliado->monto = number_format($pago_web_conciliado->monto, 2, ',', '.');
            $pago_web_conciliado->tasa = number_format($pago_web_conciliado->tasa, 2, ',', '.');
            $pago_web_conciliado->cliente_id = $pago_web_conciliado->cliente->nombres . ' ' . $pago_web_conciliado->cliente-> apellidos . ' ' . $pago_web_conciliado->cliente->cedula;
            $pago_web_conciliado->banco_origen_id = $pago_web_conciliado->banco_origen->banco;
            $pago_web_conciliado->banco_destino_id = $pago_web_conciliado->banco_destino->banco;
            $pago_web_conciliado->fecha = date('m-d-Y', strtotime($pago_web_conciliado->fecha));
        }

        return $pago_web_conciliados;
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
