<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Dokumen;
use App\Models\Dokumen_Master;


use Illuminate\Http\Request;


class DokMasterController extends Controller
{
    public function read(Request $request)
    {

        $jenis_dokumen = Jenis_Dokumen::all();
        $filter_jenis = $request->input('jenis');
        $keyword = $request->search;
        $dokumen_master = Dokumen_Master::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'dokumen_master.jenisdok_id')
            ->selectRaw('dokumen_master.*, jenis_dokumen.jenis');


        if ($filter_jenis) {
            $dokumen_master = $dokumen_master->where('dokumen_master.jenisdok_id', $filter_jenis);
        }
        if ($keyword) {
            $dokumen_master = $dokumen_master->where('nama_dok', 'like', "%" . $keyword . "%");
        }


        $dokumen_master = $dokumen_master->paginate(15);

        return view('dokumenMaster.read', [
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen,


        ]);
    }
    public function create(Request $request)
    {

        $jenis_dokumen = Jenis_Dokumen::all();
        $dokumen_master = Dokumen_Master::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'dokumen_master.jenisdok_id')
            ->selectRaw('dokumen_master.*, jenis_dokumen.jenis')
            ->get();
        return view('dokumenMaster.tambahkandata', [
            // 'request' => $request,
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen,

        ]);
    }

    public function store(Request $request)
    {

        // $jenis_dokumen = Jenis_Dokumen::all();
        // dd();
        // exit;
        $validatedData = $request->validate([
            'nama_dok' => 'required',
            'no_dok' => 'required',
            'jenisdok_id' => 'required',
            'ruangan' => 'required',
            'rak' => 'required',
            'kardus' => 'required',
            'gambar' => '',
            // 'lokasi' => 'required',

        ]);

        // dd();
        // exit;

        $validatedData['gambar'] = $request->file('gambar')->store('img-dokumen');

        Dokumen_Master::create($validatedData);
        return redirect('/dashboard')->with('toast_success', 'Data Telah Ditambahkan!');
    }

    public function edit($id)
    {


        $jenis_dokumen = Jenis_Dokumen::all();
        $dokumen_master = Dokumen_Master::find($id);
        return view('dokumenMaster.editdata', [
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen,

        ]);
    }
    public function update($id, Request $request)
    {


        $dokumen_master = Dokumen_Master::find($id);
        $jenis_dokumen = Jenis_Dokumen::find($id);
        $dokumen_master->update($request->except(['_token', 'jenis_dok']));
        // $dokumen_master->unset();

        $dokumen_master->save();
        $jenis_dokumen->save();

        // dd($id);
        // exit;
        if ($request->file('gambar')) {
            $dokumen_master->gambar = $request->file('gambar')->store('img-dokumen');
        }
        return redirect('/dashboard')->with('toast_success', 'Data Telah Diperbarui!');
    }
    public function delete($id)
    {
        $dokumen_master = Dokumen_Master::find($id);
        $dokumen_master->delete();
        return redirect('/dashboard')->with('toast_success', 'Data Telah Terhapus!');
    }
    public function lihat()
    {
        $dokumen_master = Dokumen_Master::all();
        return view('dokumenMaster.lihatData', [
            'dokumen_master' => $dokumen_master
        ]);
    }
    public function cari(Request $request)
    {
        $jenis_dokumen = Jenis_Dokumen::all();
        $filter_jenis = $request->input('jenis');
        // $filter_lokasi = $request->input('lokasi');
        $keyword = $request->search;
        $dokumen_master = Dokumen_Master::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'dokumen_master.jenisdok_id')
            ->selectRaw('dokumen_master.*, jenis_dokumen.jenis');

        if ($filter_jenis) {
            $dokumen_master = $dokumen_master->where('dokumen_master.jenisdok_id', $filter_jenis);
        }

        // if ($filter_lokasi) {
        //     $permintaan = $permintaan->where('permintaan.lokasi_id', $filter_lokasi);
        // }
        if ($keyword) {
            $dokumen_master = $dokumen_master->where('nama_dok', 'like', "%" . $keyword . "%");
        }

        $dokumen_master = $dokumen_master->paginate(10);

        return view('dokumenMaster.read', [
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen,


        ]);
    }
}
