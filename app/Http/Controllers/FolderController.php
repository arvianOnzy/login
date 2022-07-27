<?php

namespace App\Http\Controllers;

use App\Models\Dokumen_Master;
use Illuminate\Http\Request;
use App\Models\Folder;
use Carbon\Carbon;

class FolderController extends Controller
{
    public function read()
    {
        $dokumen_master = Dokumen_Master::all();
        return view('folder.folder', [
            'dokumen_master' => $dokumen_master
        ]);
    }
    public function treeFolder(Request $request)
    {
        $id = $request->input('id');
        $data = new Folder();
        if ($id === "#") {
            $data = $data->whereRaw("
                    length(tree_id)-length(replace(tree_id,'.','')) = 1
                ");
        } else {
            $data = $data->whereRaw(
                "tree_id like ? and length(tree_id)-length(replace(tree_id,'.','')) = length(?)-length(replace(?,'.','')) + 1",
                [$id . '%', $id, $id]
            );
        }

        $data = $data->whereNull('deleted_at')->get();
        $newdata = [];
        foreach ($data as $key => $value) {
            $children = Folder::whereRaw(
                "tree_id like ? and length(tree_id)-length(replace(tree_id,'.','')) = length(?)-length(replace(?,'.','')) + 1",
                [$value->tree_id . '%', $value->tree_id, $value->tree_id]
            )->whereNull('deleted_at')->count();
            $val = [
                'id' => $value->tree_id,
                'id_folder' => $value->id,
                'text' => $value->folder,
                'parent' => $id,
                'children' => $children > 0 ? true : false
            ];

            $newdata[] = $val;
        }
        return response()->json($newdata);
    }

    public function store(Request $request)
    {
        $params = [
            'id' => $request->input('id_folder'),
            'tree_id' => $request->input('tree_id') ? $request->input('tree_id') : '',
            'folder' => $request->input('folder')
        ];


        // update data
        if ($params['id']) {
            $data = Folder::find($params['id']);
            $data->update($params);
        } else {
            $new_id = Folder::selectRaw("
                    coalesce(max(cast(replace(SUBSTRING(tree_id , length(?)+ 1, length(tree_id)), '.', '') as integer)), 0) + 1 as id
                ")
                ->whereRaw("
                    length(tree_id) - length(replace(tree_id,'.','')) = length(?) - length(replace(?,'.','')) + 1
                ", [$params['tree_id'], $params['tree_id'], $params['tree_id']])
                ->first();

            $tree_id_new = $params['tree_id'] . $new_id->id . '.';
            $params['tree_id'] = $tree_id_new;
            $params['id'] = generate_uuid();
            Folder::create($params);
        }

        return response()->json(['message' => 'Data berhasil disimpan', 'success' => true], 200);
    }
    public function hapus(Request $request)
    {
        $tree_id = $request->input('tree_id');

        // cek apakah folder digunakan
        $dokumen = Dokumen_Master::where('folder_tree_id', 'like', $tree_id . '%')->count();
        if ($dokumen > 0) {
            return response()->json(['message' => 'Folder tidak bisa di hapus, masih digunakan!', 'success' => false], 200);
        }


        $data = Folder::where('tree_id', 'like', $tree_id . '%')->update(['deleted_at' => Carbon::now()]);
        return response()->json(['message' => 'Data berhasil di hapus', 'success' => true], 200);
    }
}
