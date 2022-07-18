<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Dokumen;
use App\Models\Dokumen_Master;
use App\Models\Lokasi;

use Illuminate\Http\Request;


class DokMasterController extends Controller
{
    public function read(Request $request)
    {
        $lokasi = Lokasi::all();
        $jenis_dokumen = Jenis_Dokumen::all();
        $filter_jenis = $request->input('jenis');
        $filter_lokasi = $request->input('lokasi');
        $dokumen_master = Dokumen_Master::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'dokumen_master.jenisdok_id')
            ->leftJoin('lokasi', 'lokasi.id', '=', 'dokumen_master.lokasi_id')
            ->selectRaw('dokumen_master.*, jenis_dokumen.jenis')
            ->selectRaw('dokumen_master.*, lokasi.lokasi');

        if ($filter_jenis) {
            $dokumen_master = $dokumen_master->where('dokumen_master.jenisdok_id', $filter_jenis);
        }

        if ($filter_lokasi) {
            $dokumen_master = $dokumen_master->where('dokumen_master.lokasi_id', $filter_lokasi);
        }

        $dokumen_master = $dokumen_master->paginate(15);

        return view('dokumenMaster.read', [
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen,
            'lokasi' => $lokasi,

        ]);
    }
    public function create(Request $request)
    {
        $lokasi = Lokasi::all();
        $jenis_dokumen = Jenis_Dokumen::all();
        $dokumen_master = Dokumen_Master::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'dokumen_master.jenisdok_id')
            ->leftJoin('lokasi', 'lokasi.id', '=', 'dokumen_master.lokasi_id')
            ->selectRaw('dokumen_master.*, jenis_dokumen.jenis')
            ->selectRaw('dokumen_master.*, lokasi.lokasi')
            ->get();
        return view('dokumenMaster.tambahkandata', [
            // 'request' => $request,
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen,
            'lokasi' => $lokasi
        ]);
    }

    public function store(Request $request)
    {

        // $jenis_dokumen = Jenis_Dokumen::all();
        // dd($request->gambar);
        // exit;
        $validatedData = $request->validate([
            'nama_dok' => 'required',
            'no_dok' => 'required',
            'jenisdok_id' => 'required',
            'lokasi_id' => 'required',
            'gambar' => 'required',
            // 'lokasi' => 'required',

        ]);



        $validatedData['gambar'] = $request->file('gambar')->store('img-dokumen');

        Dokumen_Master::create($validatedData);
        return redirect('/dashboard')->with('toast_success', 'Data Telah Ditambahkan!');
    }

    public function edit($id)
    {

        $lokasi = Lokasi::all();
        $jenis_dokumen = Jenis_Dokumen::all();
        $dokumen_master = Dokumen_Master::find($id);
        return view('dokumenMaster.editdata', [
            'dokumen_master' => $dokumen_master,
            'jenis_dokumen' => $jenis_dokumen,
            'lokasi' => $lokasi
        ]);
    }
    public function update($id, Request $request)
    {

        $lokasi = Lokasi::all();
        $dokumen_master = Dokumen_Master::find($id);
        $jenis_dokumen = Jenis_Dokumen::find($id);
        $dokumen_master->update($request->except(['_token', 'jenis_dok', 'gambar']));

        $dokumen_master->save();
        $jenis_dokumen->save();
        $lokasi->save();
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
}
