<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Hash;
use Auth;

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
        $validator = Validator::make($request->all(), [
            'name'  => 'required|max:255',
            'email' => ['required','email', Rule::unique('users')->ignore($user->id)],
        ]);

        // Jika Validator gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


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

    // Menampilkan form password
    public function showChangePasswordGet() {
        return view('auth.passwords.changePassword');
    }

    // Mengirim password baru & Validasi
    public function changePasswordPost(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Password lama tidak sesuai.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","Password sekarang tidak bisa digunakan.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password berhasil diubah!");
    }
}
