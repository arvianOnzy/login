<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
// use App\Http\Requests\StoreLokasiRequest;
// use App\Http\Requests\UpdateLokasiRequest;

class LokasiController extends Controller
{
    public function read()
    {
        $lokasi = Lokasi::all();
        return view('lokasiDokumen.readlokasi', [
            'lokasi' => $lokasi
        ]);
    }
    public function create(Request $request)
    {
        return view('lokasiDokumen.tambahlokasi', [
            'request' => $request
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // exit;

        $validatedData = $request->validate([
            'lokasi' => 'required',

        ]);

        Lokasi::create($validatedData);
        return redirect('/lokasi')->with('toast_success', 'Data Telah Ditambahkan!');
    }
    public function edit($id)
    {
        // dd($id);
        // exit;
        $lokasi = Lokasi::find($id);
        return view('lokasidokumen.editlokasi', [
            'lokasi' => $lokasi
        ]);
    }
    public function update($id, Request $request)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->update($request->except(['_token']));
        $lokasi->save();
        return redirect('/lokasi')->with('toast_success', 'Data Telah Dirubah!');
    }
    public function delete($id)
    {
        $lokasi = Lokasi::find($id);
        $lokasi->delete();
        return redirect('/lokasi')->with('toast_success', 'Data Telah Dihapus!');
    }
}
