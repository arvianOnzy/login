<?php

namespace App\Http\Controllers;

use App\Models\Jenis_Dokumen;
use App\Models\Permintaan;
use App\Models\Lokasi;

use Illuminate\Http\Request;


class PinjamController extends Controller
{
    public function read()
    {

        $jenis_dokumen = Jenis_Dokumen::all();
        $permintaan = Permintaan::leftJoin('jenis_dokumen', 'jenis_dokumen.id', '=', 'permintaan.jenisdok_id')
            ->selectRaw('permintaan.*, jenis_dokumen.jenis')
            ->get();
        // $permintaan = Permintaan::with('jenis_dokumen')->get();

        return view('form.form', [
            'permintaan' => $permintaan,
            'jenis_dokumen' => $jenis_dokumen,

        ]);
    }
    public function store(Request $request)
    {

        // $jenis_dokumen = Jenis_Dokumen::all();
        // dd($request->all());
        // exit;
        $validatedData = $request->validate([
            'nama_dok' => 'required',
            'no_dok' => 'required',
            'jenisdok_id' => 'required',
            // 'lokasi_id' => 'required',
            // 'jenis' => 'required',
            // 'lokasi' => 'required',

        ]);
        // if ($request->fails()) {
        //     return back()->with('errors', $request->messages()->all()[0])->withInput();
        // }

        Permintaan::create($request->all());
        return redirect('/')->with('success', 'Permintaan Telah Terkirim!');
    }
}
