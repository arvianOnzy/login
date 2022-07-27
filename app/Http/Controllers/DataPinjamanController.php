<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Dokumen;
use App\Models\Permintaan;
use App\Models\Lokasi;
use Illuminate\Http\Request;


class DataPinjamanController extends Controller
{
    public function read(Request $request)
    {

        $lokasi = Lokasi::all();
        $jenis_dokumen = Jenis_Dokumen::all();
        $filter_jenis = $request->input('jenis');

        $keyword = $request->search;
        $permintaan = Permintaan::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'permintaan.jenisdok_id')
            ->selectRaw('permintaan.*, jenis_dokumen.jenis');

        if ($filter_jenis) {
            $permintaan = $permintaan->where('permintaan.jenisdok_id', $filter_jenis);
        }


        if ($keyword) {
            $permintaan = $permintaan->where('nama_dok', 'like', "%" . $keyword . "%");
        }

        $permintaan = $permintaan->paginate(10);

        return view('dataPinjaman.readPinjaman', [
            'permintaan' => $permintaan,
            'jenis_dokumen' => $jenis_dokumen,
            'lokasi' => $lokasi
        ]);
    }
    public function search(Request $request)
    {

        $lokasi = Lokasi::all();
        $jenis_dokumen = Jenis_Dokumen::all();
        // $filter_jenis = $request->input('jenis');
        // $filter_lokasi = $request->input('lokasi');
        $keyword = $request->search;
        $permintaan = Permintaan::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'permintaan.jenisdok_id')
            ->selectRaw('permintaan.*, jenis_dokumen.jenis');

        // if ($filter_jenis) {
        //     $permintaan = $permintaan->where('permintaan.jenisdok_id', $filter_jenis);
        // }

        // if ($filter_lokasi) {
        //     $permintaan = $permintaan->where('permintaan.lokasi_id', $filter_lokasi);
        // }
        if ($keyword) {
            $permintaan = $permintaan->where('nama_dok', 'like', "%" . $keyword . "%");
        }

        $permintaan = $permintaan->paginate(10);

        return view('dataPinjaman.readPinjaman', [
            'permintaan' => $permintaan,
            'jenis_dokumen' => $jenis_dokumen,
            'lokasi' => $lokasi
        ]);
    }
    public function approve($id, Request $request)
    {

        // $lokasi = Lokasi::all();
        // $jenis_dokumen = Jenis_Dokumen::all();
        // $filter_jenis = $request->input('jenis');
        // $filter_lokasi = $request->input('lokasi');
        // $approve = $request->search;
        // $permintaan = Permintaan::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'permintaan.jenisdok_id')
        //     ->leftJoin('lokasi', 'lokasi.id', '=', 'permintaan.lokasi_id')
        //     ->selectRaw('permintaan.*, jenis_dokumen.jenis')
        //     ->selectRaw('permintaan.*, lokasi.lokasi');
        $permintaan = Permintaan::find($id);

        // if ($filter_jenis) {
        //     $permintaan = $permintaan->where('permintaan.jenisdok_id', $filter_jenis);
        // }

        // if ($filter_lokasi) {
        //     $permintaan = $permintaan->where('permintaan.lokasi_id', $filter_lokasi);
        // }
        if ($permintaan) {
            $permintaan = $permintaan->approved = true;
        }

        // $permintaan = $permintaan->paginate(10);
        return redirect()->back()->with('toast_success', 'Data Telah Di Verifikasi');
        // return view('dataPinjaman.readPinjaman', [
        //     'permintaan' => $permintaan,
        //     // 'jenis_dokumen' => $jenis_dokumen,
        //     // 'lokasi' => $lokasi
        // ]);
    }
}
