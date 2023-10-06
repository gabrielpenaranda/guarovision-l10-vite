<?php

namespace App\Exports;

use App\Models\PagoTaquilla;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class PagoTaquillaReporteExport implements FromCollection, WithHeadings
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

        $pago_taquillas = PagoTaquilla::where('created_at', '>=', $inicio . 'T00:00:00.000000Z')
        ->where('created_at', '<=', $final . 'T23:59:59.000000Z')
        ->orderBy('pago_taquilla', 'asc')
        ->with('cliente')
        ->with('banco_pos')
        ->with('divisa')
        ->with('taquilla')
        ->get();

        foreach($pago_taquillas as $pago_taquilla) {
            $pago_taquilla->monto_total = number_format($pago_taquilla->monto_total, 2, ',', '.');
            $pago_taquilla->monto_divisa = number_format($pago_taquilla->monto_divisa, 2, ',', '.');
            $pago_taquilla->monto_efectivo_bs = number_format($pago_taquilla->monto_efectivo_bs, 2, ',', '.');
            $pago_taquilla->monto_efectivo_divisa = number_format($pago_taquilla->monto_efectivo_divisa, 2, ',', '.');
            $pago_taquilla->tasa = number_format($pago_taquilla->tasa, 2, ',', '.');
            $pago_taquilla->divisa_id = $pago_taquilla->divisa->divisa;
            $pago_taquilla->banco_pos_id = $pago_taquilla->banco_pos->banco;
            $pago_taquilla->taquilla_id = $pago_taquilla->taquilla->taquilla;
            $pago_taquilla->cliente_id = $pago_taquilla->cliente->nombres.' '. $pago_taquilla->cliente->apellidos . ' ' . $pago_taquilla->cliente->cedula;
            $pago_taquilla->fecha = date('m-d-Y', strtotime($pago_taquilla->fecha));

        }

        return $pago_taquillas;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nº Pago',
            'Fecha',
            'Total x Pagar',
            'Monto Efectivo Bs',
            'Monto Efectivo Divisa',
            'Monto Bs POS',
            'Tasa 1US$->Bs',
            'Divisa',
            'Banco POS',
            'Taquilla',
            'Cliente',
            'Fecha Creacion',
            'Fecha Actualizacion',
        ];
    }
}
