<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class UserController extends Controller
{
    public function read()
    {
        $user = User::all();
        return view('user.userRead', [
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('user.tambahUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        // event(new Registered($user));

        // Auth::login($user);

        User::create($request);
        return redirect('/user');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.userEdit', [
            'user' => $user
        ]);
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->except(['_token']));

        $user->save();
        return redirect('/user');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
}
