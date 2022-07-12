<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Dokumen;
use App\Models\Dokumen_Master;
use App\Models\Lokasi;

use Illuminate\Http\Request;

class PinjamController extends Controller
{
    public function read()
    {
        $lokasi = Lokasi::all();
        $jenis_dokumen = Jenis_Dokumen::all();
        $dokumen_master = Dokumen_Master::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'dokumen_master.jenisdok_id')
            ->leftJoin('lokasi', 'lokasi.id', '=', 'dokumen_master.lokasi_id')
            ->selectRaw('dokumen_master.*, jenis_dokumen.jenis')
            ->selectRaw('dokumen_master.*, lokasi.lokasi')
            ->get();
        // $dokumen_master = Dokumen_Master::where('jenis_dokumen', '=', $jenis_dokumen)
        //     ->where('lokasi', '=', $lokasi)
        //     ->get();
        return view('form.form', [
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen,
            'lokasi' => $lokasi
        ]);
    }
}
