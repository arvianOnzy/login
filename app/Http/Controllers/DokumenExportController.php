<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DokumenExport;

class DokumenExportController extends Controller
{
    public function export()
    {
        return Excel::download(new DokumenExport, 'Dokumen.xlsx');
    }
}
