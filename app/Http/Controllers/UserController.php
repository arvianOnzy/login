<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
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
        $user = User::all()->where('role_id');
        return view('user.readUser', [
            'user' => $user,
            // 'role' => $role
        ]);
    }

    public function create()
    {
        // $role = Role::all();
        $user = User::all()->where('role_id');
        return view('user.tambahUser', [
            'user' => $user,
            // 'role' => Role::find($id)
            // 'role' => $role
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'nip' => '',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => 'required',
        ]);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // dd($request);
        // exit;
        User::create($request);
        return redirect('/user');
    }
    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();
        return view('user.userEdit', [
            'user' => $user,
            'role' => $role
        ]);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $role = Role::find($id);
        $user->update($request->except(['_token']));

        $user->save();
        $role->save();

        return redirect('/user')->with('toast_success', 'Data Telah Diperbarui!');
    }

    public function delete($id)
    {
        $user = User::find($id)->where('role_id');
        $user->delete();
        return redirect('/user');
    }
}
