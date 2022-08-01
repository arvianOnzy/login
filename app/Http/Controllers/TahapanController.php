<?php

namespace App\Http\Controllers;

use App\Models\TahapanHdr;
use App\Models\TahapanDtl;
use Carbon\Carbon;
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

    public function detail($id, Request $request){
        $tahapan = TahapanHdr::where('id',$id)->first();
        $detail = TahapanDtl::whereNull('deleted_at')->where('tahapan_hdr_id',$id)->orderBy('urutan','asc')->get();

        // jika request dari ajax
        if($request->ajax()){
            return response()->json(['data' => $detail, 'message' => 'Data berhasil di dapat', 'success' => true], 200);
        }
        return view('tahapan.detail',compact('tahapan','detail'));
    }

    public function tahapanById(Request $request){
        $id = $request->input('id');
        $tahapan = TahapanDtl::where('id',$id)->first();
        return response()->json(['data' => $tahapan, 'message' => 'Data berhasil di dapat', 'success' => true], 200);
    }

    public function hapus(Request $request){
        $id = $request->input('id');
        $data = TahapanDtl::where('id',$id)->first();
        // soft delete
        $data->deleted_at = Carbon::now();
        $data->save();
         return response()->json(['message' => 'Data berhasil di hapus', 'success' => true], 200);
    }

    public function storeSequence(Request $request){
        $params = [
            'id'=>$request->input('id'),
            'nama'=>$request->input('nama'),
            'urutan'=>$request->input('urutan'),
            'tahapan_hdr_id'=>$request->input('tahapan_hdr_id')
        ];

        if($params['id']){
            // update data
            $data = TahapanDtl::where('id',$params['id'])->first();
            $data->update($params);
        }
        else{
            // insert ke database
            $params['id'] = generate_uuid();
            TahapanDtl::create($params);

        }

        return response()->json(['message' => 'Data berhasil disimpan', 'success' => true], 200);
    }
}
