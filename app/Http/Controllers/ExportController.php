<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Excel;

use App\Exports\ClientesExport;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exporta_clientes(Excel $excel)
    {
                return $excel->download(new ClientesExport(), 'clientes_guarovision.xlsx');
    }
}
