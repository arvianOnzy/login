<?php

namespace App\Http\Controllers;

use App\Models\TahapanHdr;
use App\Models\TahapanDtl;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TahapanController extends Controller
{
    public function index(Request $request)
    {
        $tahapan = TahapanHdr::all();
        if ($request->ajax()) {
            return response()->json(['message' => 'Data berhasil di dapat', 'data' => $tahapan], 200);
        }
        return view('tahapan.index', compact('tahapan'));
    }

    public function store(Request $request)
    {
        $id = $request->input('id');
        $tahapan = $request->input('master_tahapan');
        if ($id) {
            // update
            $data = TahapanHdr::where('id', $id)->first();
            $data->update(['master_tahapan' => $tahapan]);
        } else {
            // insert

            $data = TahapanHdr::create(['master_tahapan' => $tahapan]);
        }


        return response()->json(['id' => $data->id, 'message' => 'Data berhasil disimpan', 'success' => true], 200);
    }

    public function hdrById(Request $request)
    {
        $id = $request->input('id');
        $data = TahapanHdr::find($id);
        return response()->json(['message' => 'Data berhasil di dapat', 'data' => $data], 200);
    }

    public function detail($id, Request $request)
    {

        // $detail = TahapanDtl::leftJoin('unit', 'unit.id', '=', 'detail.role_id')
        //     ->leftJoin('unit', 'unit.id', '=', 'detail.unit_id')
        //     // ->selectRaw('user.*', 'role.nama');
        //     ->get();
        $tahapan = TahapanHdr::where('id', $id)->first();
        $detail = TahapanDtl::whereNull('deleted_at')->where('tahapan_hdr_id', $id)->orderBy('urutan', 'asc')->get();

        // jika request dari ajax
        if ($request->ajax()) {
            return response()->json(['data' => $detail, 'message' => 'Data berhasil di dapat', 'success' => true], 200);
        }
        return view('tahapan.detail', compact('tahapan', 'detail'));
    }

    public function tahapanById(Request $request)
    {
        $id = $request->input('id');
        $tahapan = TahapanDtl::where('id', $id)->first();
        return response()->json(['data' => $tahapan, 'message' => 'Data berhasil di dapat', 'success' => true], 200);
    }

    public function hapus(Request $request)
    {
        $id = $request->input('id');
        $data = TahapanDtl::where('id', $id)->first();
        // soft delete
        $data->deleted_at = Carbon::now();
        $data->save();
        return response()->json(['message' => 'Data berhasil di hapus', 'success' => true], 200);
    }

    public function storeSequence(Request $request)
    {
        $params = [
            'id' => $request->input('id'),
            'nama' => $request->input('nama'),
            'urutan' => $request->input('urutan'),
            'tahapan_hdr_id' => $request->input('tahapan_hdr_id')
        ];

        if ($params['id']) {
            // update data
            $data = TahapanDtl::where('id', $params['id'])->first();
            $data->update($params);
        } else {
            // insert ke database
            $params['id'] = generate_uuid();
            TahapanDtl::create($params);
        }

        return response()->json(['message' => 'Data berhasil disimpan', 'success' => true], 200);
    }
}
