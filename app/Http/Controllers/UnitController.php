<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function read(Request $request)
    {
        $unit = Unit::all();
        return view('unit.readUnit', [
            'unit' => $unit
        ]);
    }
    public function create(Request $request)
    {
        return view('unit.tambahUnit', [
            'request' => $request
        ]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // exit;
        $validatedata = $request->validate([
            'nama_unit' => 'required'
        ]);

        Unit::create($validatedata);
        return redirect('/unit')->with('toast_success', 'Data Ditambahakan!');
    }
    public function edit($id)
    {
        // dd($id);
        // exit;
        $unit = Unit::find($id);
        return view('unit.editunit', [
            'unit' => $unit
        ]);
    }
    public function update($id, Request $request)
    {
        $unit = Unit::find($id);
        $unit->update($request->except(['_token']));
        $unit->save();
        return redirect('/unit')->with('toast_success', 'Data Telah Dirubah!');
    }
    public function delete($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect('/unit')->with('toast_success', 'Data Telah Dihapus!');
    }
}
