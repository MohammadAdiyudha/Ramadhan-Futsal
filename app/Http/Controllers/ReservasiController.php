<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

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

        try {
            $validator = Validator::make($request->all(), [
                'no_hp'  => 'required|min:10',
                'tanggal'  => 'required',
                'jam_awal'  => 'required',
                'jam_akhir'  => 'required',
            ]);

            // Jika Validator gagal
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            };
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

        } catch(\Illuminate\Database\QueryException $e){
            // Handling error duplicate
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return redirect()->back()->with('error','Jadwal Bentrok! Silahkan cari jadwal lain');
            }
        }

    }

    public function hapus($reservasi_id){
        DB::table('reservasis')->where('reservasi_id', $reservasi_id)->delete();
        return redirect()->back()->with('success','Hapus data berhasil');
    }

    public function edit($id)
    {
        $reservasi   = DB::table('reservasis')
                        ->where('reservasi_id','=',$id)
                        ->first();
        // Cek owner
        if($reservasi->user_id != auth()->id()) {
            // Jika mencoba akses data user lain
            return back()->with('error','Hayooo ngapain?');
        } else {
            // Jika berhasil
            return view('editReservasi')->with('reservasi', $reservasi);
        }


    }

    public function update(Request $request, $id)
    {

        $reservasi = Reservasi::find($id);
        $validator = Validator::make($request->all(), [
            'no_hp'  => 'required|min:10',
            'tanggal'  => 'required',
            'jam_awal'  => 'required',
            'jam_akhir'  => 'required',
        ]);

        // Jika Validator gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        };
        $reservasi->no_hp = $request->input('no_hp');
        $reservasi->tanggal = $request->input('tanggal');
        $reservasi->jam_awal = $request->input('jam_awal');
        $reservasi->jam_akhir = $request->input('jam_akhir');
        $reservasi->durasi = $request->input('durasi');
        $reservasi->harga = $request->input('harga');
        $reservasi->status = "Pending";
        $reservasi->update();

        return redirect("data-reservasi")->with('success','Ubah data berhasil');
    }


    public function lihatBayar($id)
    {
        $pembayaran   = DB::table('pembayarans')
                        ->where('reservasi_id','=',$id)
                        ->first();
        return view('lihatBayar')->with('pembayaran', $pembayaran);

    }
}
