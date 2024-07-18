<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PemesananExport;

class ExportController extends Controller
{
    //
    public function exportPemesanan()
    {
        return Excel::download(new PemesananExport, 'pemesanan.xlsx');
    }
}
