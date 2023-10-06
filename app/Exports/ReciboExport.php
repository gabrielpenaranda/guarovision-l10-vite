<?php

namespace App\Exports;

use App\Models\Recibo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReciboExport implements FromCollection, WithHeadings
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

        $recibos = Recibo::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
            ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
            ->with('cliente')
            ->with('divisa')
            ->get();

        foreach ($recibos as $recibo) {
            $recibo->monto_divisa = number_format($recibo->monto_divisa, 2, ',', '.');
            $recibo->saldo = number_format($recibo->saldo, 2, ',', '.');
            $recibo->monto_efectivo_divisa = number_format($recibo->monto_efectivo_divisa, 2, ',', '.');
            $recibo->tasa = number_format($recibo->tasa, 2, ',', '.');
            $recibo->divisa_id = $recibo->divisa->divisa;
            $recibo->cliente_id = $recibo->cliente->nombres . ' ' . $recibo->cliente-> apellidos . ' ' . $recibo->cliente->cedula;
            $recibo->fecha = date('m-d-Y', strtotime($recibo->fecha));
            $recibo->fecha_vencimiento = date('m-d-Y', strtotime($recibo->fecha_vencimiento));
        }

        return $recibos;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nº Consumo',
            'Fecha',
            'Fecha Vencimiento',
            'Concepto',
            'Monto Divisa',
            'Saldo',
            'Pagado',
            'Exento',
            'Cliente',
            'Divisa',
            'Fecha Creacion',
            'Fecha Actualizacion',
        ];
    }
}