<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Reservasi;

class ReservasiController extends Controller
{
    //
    // public function index() {
    //     $reservasi = DB::select('select * from reservasis');
    //     return view('reservasi.tampil',['reservasis'=>$reservasi]);
    //  }

    public function create()
    {
        return view('buatReservasi');
    }

    public function store(Request $request)
    {
        $reservasi = new Reservasi;
        $user = Auth::user();
        $reservasi->reservasi_id = $user->id;
        $reservasi->no_hp = $request->input('no_hp');
        $reservasi->tanggal = $request->input('tanggal');
        $reservasi->jam_awal = $request->input('jam_awal');
        $reservasi->jam_akhir = $request->input('jam_akhir');
        $reservasi->lama = $request->input('lama');
        $reservasi->harga = $request->input('harga');
        $reservasi->status = $request->input('status');
        $reservasi->save();
        return redirect()->back()->with('status','Reservasi Berhasil Dibuat');
    }
}
