<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


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
        $reservasi = Reservasi::where('user_id','=',$user_getID)
                    ->get();
        return view('dataReservasi',['reservasis'=>$reservasi]);

        // DEBUG RELATIONSHIP 1-on-1 RESERVASI - PEMBAYARAN
        // $bayar = Reservasi::find(3)->pembayaran->atas_nama;
        // $reservasi = Pembayaran::find(3)->reservasi->tanggal;
        // dd($bayar,$reservasi);
     }

     // Tampil Reservasi Sisi ADMIN
    public function indexAdmin() {
        $reservasi = Reservasi::all();
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

            // Untuk Double Booking
            // Tambah * Kurang 1 Detik
            $parseJamAwal = Carbon::createFromFormat('H:i:s',$request->input('jam_awal'));
            $newJamAwal = $parseJamAwal->addSecond()->toTimeString();
            $parseJamAkhir = Carbon::createFromFormat('H:i:s',$request->input('jam_akhir'));
            $newJamAkhir = $parseJamAkhir->subSecond()->toTimeString();
            // dd($newJamAwal,$newJamAkhir);

            // Algoritma Duble Booking / Jadwal Bentrok
            $cekBooked = Reservasi::where('tanggal', $request->input('tanggal'))
                                    ->where(
                                        fn ($q) => $q->whereBetween('jam_awal', [$newJamAwal, $newJamAkhir])
                                                    ->orWhereBetween('jam_akhir', [$newJamAwal, $newJamAkhir])
                                                    ->orWhere (
                                                        fn ($q) => $q->where('jam_awal', '<', $newJamAwal)
                                                                    ->where('jam_akhir', '>', $newJamAkhir)
                                                    )
                                    )
                                    ->exists();
            // Debug
            // dd($newJamAwal,$newJamAkhir,$cekBooked);

            // Jika ada jadwal bentrok
            if ($cekBooked) {
                return redirect()->back()->with('error','JADWAL BENTROK!!! Ganti ke jadwal lain');
            // Jika jadwal tidak bentrok
            } else {
                $reservasi->user_id = $user->id;
                $reservasi->no_hp = $request->input('no_hp');
                $reservasi->tanggal = $request->input('tanggal');
                $reservasi->jam_awal = $request->input('jam_awal');
                $reservasi->jam_akhir = $request->input('jam_akhir');
                $reservasi->durasi = $request->input('durasi');
                $reservasi->harga = $request->input('harga');
                $reservasi->status = "Pending";
                $reservasi->save();
                return redirect("data-reservasi")->with('success','Reservasi Berhasil Dibuat');
            }

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
        // OLD DATA - TEMPORARY
        $oldJamAwal = $reservasi->jam_awal;
        $oldJamAkhir = $reservasi->jam_akhir;
        $oldDurasi = $reservasi->durasi;
        $oldHarga = $reservasi->harga;

        // WAJIB - jika edit tidak ada perubahan
        // Set NULL agar tidak error saat tidak ada perubahan
        $reservasi->jam_awal = NULL;
        $reservasi->jam_akhir = NULL;
        $reservasi->durasi = NULL;
        $reservasi->harga = NULL;
        $reservasi->update();

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

        // Untuk Double Booking
        // Tambah * Kurang 1 Detik
        $parseJamAwal = Carbon::createFromFormat('H:i:s',$request->input('jam_awal'));
        $newJamAwal = $parseJamAwal->addSecond()->toTimeString();
        $parseJamAkhir = Carbon::createFromFormat('H:i:s',$request->input('jam_akhir'));
        $newJamAkhir = $parseJamAkhir->subSecond()->toTimeString();
        // dd($newJamAwal,$newJamAkhir);

        // Algoritma Duble Booking / Jadwal Bentrok
        $cekBooked = Reservasi::where('tanggal', $request->input('tanggal'))
                                ->where(
                                    fn ($q) => $q->whereBetween('jam_awal', [$newJamAwal, $newJamAkhir])
                                                ->orWhereBetween('jam_akhir', [$newJamAwal, $newJamAkhir])
                                                ->orWhere (
                                                    fn ($q) => $q->where('jam_awal', '<', $newJamAwal)
                                                                ->where('jam_akhir', '>', $newJamAkhir)
                                                )
                                )
                                ->exists();
        // Jika ada jadwal bentrok
        if ($cekBooked) {
            // Data dikembalikan ke old data
            $reservasi->jam_awal = $oldJamAwal;
            $reservasi->jam_akhir = $oldJamAkhir;
            $reservasi->durasi = $oldDurasi;
            $reservasi->harga = $oldHarga;
            $reservasi->update();
            return redirect()->back()->with('error','JADWAL BENTROK!!! Ganti ke jadwal lain');
        // Jika jadwal tidak bentrok
        } else {
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


    }

    public function setStatus(Request $request)
    {
        $reservasi = Reservasi::find($request->input('stReservasiID'));
        $reservasi->status = $request->input('setStatus');
        $reservasi->update();

        return redirect("admin/data-reservasi")->with('success','Ubah status berhasil');
    }
}
