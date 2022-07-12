<?php

namespace App\Http\Controllers;

use App\Models\Dokumen_Master;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function read()
    {
        $dokumen_master = Dokumen_Master::all();
        return view('folder.folder', [
            'dokumen_master' => $dokumen_master
        ]);
    }
    public function create(Request $request)
    {

        return view('folder.tambahfolder', [
            'request' => $request
        ]);
    }
    public function store(Request $request)
    {
        return redirect('folder.folder');
    }
    public function edit()
    {
        $dokumen_master = Dokumen_Master::all();
        return view('folder.editfolder', [
            'dokumen_master' => $dokumen_master
        ]);
    }
    public function update($id, Request $request)
    {
        $dokumen_master = Dokumen_Master::find($id);
        $dokumen_master->update()->except($request(['_token']));
        $dokumen_master->save();
        return redirect('folder.folder');
    }
    public function delete($id)
    {
        $dokumen_master = Dokumen_Master::find($id);
        $dokumen_master->delete();
        return redirect('folder.folder');
    }
}
