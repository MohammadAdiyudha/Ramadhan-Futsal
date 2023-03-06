<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index() {
        $akun_user = DB::select('select * from users');
        return view('admin/dataUser',['users'=>$akun_user]);
     }

     public function edit($id)
    {
        $user   = User::whereId($id)->first();
        return view('admin/editUser')->with('user', $user);
        // return view('admin/editUser', compact('user'));

    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_admin = $request->input('role');
        $user->email_verified_at = $request->input('verifikasi');
        $user->update();

        return redirect('admin/data-user')->with('success','Ubah data berhasil');
    }

    public function hapus($id){
        $user   = User::find($id);
        $user->delete();

        return redirect('admin/data-user')->with('success','Hapus data berhasil');
    }
}
