<?php

namespace App\Http\Controllers;

use App\Models\Dokumen_Master;

use App\Models\Jenis_Dokumen;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index(Request $request)
    {
        $dokumen_master = Dokumen_Master::with(['jenis']);
        if ($request->get('jenis')) {
            $jenis = $request->jenis;
            $dokumen_master->whereHas(
                'jenis',
                function ($query) use ($jenis) {
                    $query->where('name', 'LIKE', "%{$jenis}%");
                }
            );
        } else {
        }


        return view('dokumenMaster.read', [
            'dokumen_master' => $dokumen_master->paginate(5),
            'jenis_dokumen' => Jenis_Dokumen::all()
        ]);
    }
}
