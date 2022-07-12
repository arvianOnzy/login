<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Dokumen;
use App\Models\Dokumen_Master;
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
        // $jenis_dokumen = Jenis_Dokumen::where('dokumen_id', $id)->get();
        $dokumen_master = Dokumen_Master::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'dokumen_master.jenisdok_id')
            ->selectRaw('dokumen_master.*, jenis_dokumen.jenis')
            ->get();
        $jenis_dokumen = Jenis_Dokumen::all();
        return view('dataPinjaman.readPinjaman', [
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen
        ]);
    }
}
