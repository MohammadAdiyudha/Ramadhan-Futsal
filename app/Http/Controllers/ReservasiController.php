<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Reservasi;
use DB;

class ReservasiController extends Controller
{
    // Tampil Reservasi Sisi USER
    public function indexUser() {
        $user_table = Auth::user();
        $user_getID = $user_table->id;
        $reservasi = DB::table('reservasis')
                        ->select('*')
                        ->where('user_id','=',$user_getID)
                        ->get();
                        return view('dataReservasi',['reservasis'=>$reservasi]);
     }

     // Tampil Reservasi Sisi ADMIN
    public function indexAdmin() {
        $reservasi = DB::table('reservasis')
                        ->select('*')
                        ->get();
        return view('dataReservasi',['reservasis'=>$reservasi]);
     }

    public function create()
    {
        return view('buatReservasi');
    }

    public function store(Request $request)
    {
        $reservasi = new Reservasi;
        $user = Auth::user();
        $reservasi->user_id = $user->id;
        $reservasi->no_hp = $request->input('no_hp');
        $reservasi->tanggal = $request->input('tanggal');
        $reservasi->jam_awal = $request->input('jam_awal');
        $reservasi->jam_akhir = $request->input('jam_akhir');
        $reservasi->durasi = $request->input('durasi');
        $reservasi->harga = $request->input('harga');
        $reservasi->status = "Pending";
        $reservasi->save();
        return redirect()->back()->with('success','Reservasi Berhasil Dibuat');
    }

    public function hapus($reservasi_id){
        DB::table('reservasis')->where('reservasi_id', $reservasi_id)->delete();
        return redirect()->back()->with('success','Hapus data berhasil');
    }
}
