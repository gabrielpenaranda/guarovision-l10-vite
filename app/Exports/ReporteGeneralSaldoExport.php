<?php

namespace App\Exports;

use App\Models\ReporteGeneralSaldo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReporteGeneralSaldoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $rgs = ReporteGeneralSaldo::select('cliente', 'fecha', 'numero', 'concepto', 'monto_divisa', 'saldo')->get();
        return $rgs;
    }

    public function headings(): array
    {
        return [
            'Cliente',
            'Fecha',
            'Nº Consumo',
            'Concepto',
            'Monto Divisa',
            'Saldo',
        ];
    }
}
