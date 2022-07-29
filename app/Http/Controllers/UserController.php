<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;

class UserController extends Controller
{
    public function read()
    {
        // $role = new Role();
        $role = Role::all();
        $unit = Unit::all();
        $user = User::leftJoin('role', 'role.id', '=', 'user.role_id')
            ->leftJoin('unit', 'unit.id', '=', 'user.unit_id')
            ->selectRaw('user.*, role.nama')
            ->selectRaw('user.*, unit.nama_unit')
            // ->selectRaw('user.*', 'role.nama');
            ->get();

        // ->get(['user.*', 'unit.nama_unit']);

        // $user = $user->paginate(10);

        return view('user.readUser', [
            'user' => $user,
            'role' => $role,
            'unit' => $unit
        ]);
    }

    public function create()
    {
        $role = Role::all();
        $unit = Unit::all();
        $user = User::leftJoin('role', 'role.id', '=', 'user.role_id')
            ->leftJoin('unit', 'unit.id', '=', 'user.unit_id')
            ->selectRaw('user.*, role.nama')
            ->selectRaw('user.*, unit.nama_unit')
            // ->selectRaw('user.*', 'role.nama');
            ->get();

        return view('user.tambahUser', [
            'user' => $user,
            'role' => $role,
            'unit' => $unit
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        // exit;

        $request->validate([

            'nip' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required'],
            'unit_id' => ['required'],
        ]);

        User::create([
            'nip' => $request->nip,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'unit_id' => $request->unit_id,
        ]);

        // dd($request);
        // exit;
        // User::create($request);
        return redirect('/user');
    }
    public function edit($id)
    {
        // echo 'a';
        // exit;
        $user = User::find($id);
        $role = Role::all();
        $unit = Unit::all();
        return view('user.userEdit', [
            'user' => $user,
            'role' => $role,
            'unit' => $unit
        ]);
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        // exit;
        $params = [
            'nip' => $request->input('nip'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role_id'),
            'unit_id' => $request->input('unit_id'),
            'password' => $request->input('password'),
        ];
        $user = User::find($id);
        if (!$params['password']) {
            unset($params['password']);
        }
        $user->update($params);

        $user->save();


        return redirect('/user')->with('toast_success', 'Data Telah Diperbarui!');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('toast_success', 'Data Telah Dihapus!');
    }
    public function lihat($id)
    {
        $user = User::find($id)->with('role')->get();
        return view('user.lihatUser', [
            'user' => $user
        ]);
    }
}
