<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = array(
            'title' => 'Data User',
            'data_user' => User::all()
        );

        return view('admin.master.user.list', $data);
    }

    public function store(Request $request)
    {
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->Hash::make($request->password),
            'role'      => $request->role
        ]);

        return redirect('/user')->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id)
    {
        User::where('id', $id)
            ->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => $request->Hash::make($request->password),
                'role'      => $request->role
        ]);

        return redirect('/user')->with('success', 'Data Berhasil Di Ubah');

    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return redirect('/user')->with('success', 'Data Berhasil Dihapus');
    }
}
