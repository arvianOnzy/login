<?php

namespace App\Http\Controllers;

use App\Models\Dokumen_Master;
use App\Models\Jenis_Dokumen;
use Illuminate\Http\Request;

class jenisDokumenController extends Controller
{
    public function read()
    {
        $jenis_dokumen = Jenis_Dokumen::all();
        return view('jenisDokumen.readJenis', [
            'jenis_dokumen' => $jenis_dokumen
        ]);
    }
    public function create(Request $request)
    {
        return view('jenisDokumen.tambahkanjenis', [
            'request' => $request
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // exit;

        $validatedData = $request->validate([
            'jenis' => 'required',

        ]);

        Jenis_Dokumen::create($validatedData);
        return redirect('/jenis-dokumen');
    }


    // public function edit($id)
    // {
    //     // dd($id);
    //     // exit;
    //     $jenis_dokumen = Jenis_Dokumen::find($id);
    //     return view('jenisDokumen.editdata', [
    //         'jenis_dokumen' => $jenis_dokumen
    //     ]);
    // }
    // public function update($id, Request $request)
    // {
    //     $jenis_dokumen = Jenis_Dokumen::find($id);
    //     $jenis_dokumen->update($request->except(['_token']));
    //     $jenis_dokumen->save();
    //     return redirect('/dashboard');
    // }
    // public function delete($id)
    // {
    //     $jenis_dokumen = Jenis_Dokumen::find($id);
    //     $jenis_dokumen->delete();
    //     return redirect('/dashboard');
    // }
}
