<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Banco;
use App\Models\MovimientoBanco;

use Illuminate\Support\Carbon;

class MovimientoBancoImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new MovimientoBanco([
            'codigo' => (string)$row['codigo'],
            //'fecha' => date('Y-d-m', strtotime($row['fecha'])),
            'fecha' => $this->toDate((string)$row['fecha']),
            //dd(strtotime($row['fecha'])),
            'referencia' => (string)$row['referencia'],
            'cedula' => (string)$row['cedula'],
            'telefono' => (string)$row['telefono'],
            //dd($this->tofloat($row['monto'])),
            'monto' => $this->tofloat($row['monto']),
            'banco_id' => Banco::where('codigo', $row['codigo'])->first()->id,
        ]);
    }

    private function tofloat($num)
    {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos : ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }

        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
                preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
        );
    }

    private function toDate($date)
    {
        /* $dia = substr($date, 0, 2);
        $mes = substr($date, 3, 2);
        $ano = substr($date, 6, 4); */
        return $today = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        //dd($today);
    }
}