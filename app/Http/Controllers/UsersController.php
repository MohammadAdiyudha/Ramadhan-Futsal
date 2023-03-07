<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;

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

    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);

        // Validasi email unique, dengan kondisi abaikan id yang diedit
        $this->validate($request, [
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_admin = $request->input('role');
        if ($user->email_verified_at == NULL){
            $user->email_verified_at = $request->input('verifikasi');
        };
        $user->update();

        return redirect('admin/data-user')->with('success','Ubah data berhasil');
    }

    public function hapus($id){
        $user   = User::find($id);
        $user->delete();

        return redirect('admin/data-user')->with('success','Hapus data berhasil');
    }
}
