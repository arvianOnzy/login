<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Dokumen;
use App\Models\Permintaan;
use App\Models\Lokasi;
use Illuminate\Http\Request;


class DataPinjamanController extends Controller
{
    public function read(Request $requests)
    // public function approve(Request $request, Penelitian $penelitian)
    // {

    //     $save['status'] = $request->status;
    //     // return $save['status'];
    //     Penelitian::where('id', $penelitian->id)
    //         ->update($save);
    //     if ($save['status'] == 'disetujui') {
    //         return back()->with('successApprove', 'Penelitian Berhasil Di Setujui');
    //     } else {
    //         return back()->with('successApprove', 'Penelitian Berhasil Di ditolak');
    //     }
    // }
    {

        $lokasi = Lokasi::all();
        $jenis_dokumen = Jenis_Dokumen::all();
        $permintaan = Permintaan::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'permintaan.jenisdok_id')
            ->leftJoin('lokasi', 'lokasi.id', '=', 'permintaan.lokasi_id')
            ->selectRaw('permintaan.*, jenis_dokumen.jenis')
            ->selectRaw('permintaan.*, lokasi.lokasi');
        $permintaan = $permintaan->paginate(10);

        return view('dataPinjaman.readPinjaman', [
            'permintaan' => $permintaan,
            'jenis_dokumen' => $jenis_dokumen,
            'lokasi' => $lokasi
        ]);
    }
}
