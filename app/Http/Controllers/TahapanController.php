<?php

namespace App\Http\Controllers;

use App\Models\TahapanHdr;
use App\Models\TahapanDtl;

use Illuminate\Http\Request;

class TahapanController extends Controller
{
    public function index()
    {
        return view('tahapan.index');
    }

    public function store(Request $request)
    {
        $tahapan = $request->input('master_tahapan');
        $data = TahapanHdr::create(['master_tahapan' => $tahapan]);

        return response()->json(['id' => $data->id, 'message' => 'Data berhasil disimpan', 'success' => true], 200);
    }
}
