<?php

namespace App\Http\Controllers;

use App\Models\Dokumen_Master;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class DokumenImportController extends Controller
{
    public function import()
    {
        // Excel::import(new Dokumen_Master(), 'Dokumen.xlsx');
        Excel::import(new Dokumen_Master(), request()->file('dokumen'));
        return back()->with('success', 'Data Berhasil Diimport!');
    }
}
