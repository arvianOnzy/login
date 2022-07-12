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
        return redirect('/lokasi');
    }
}
