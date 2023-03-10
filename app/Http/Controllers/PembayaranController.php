<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Pembayaran;
use App\Models\Reservasi;
use DB;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function store(Request $request)
    {
        $pembayaran = new Pembayaran;
        $reservasi = new Reservasi;
        try {
            $pembayaran->atas_nama = $request->input('atas_nama');
            $pembayaran->jenis_bayar = $request->input('jenis_bayar');

            if($request->hasfile('bukti_bayar'))
            {
                $file = $request->file('bukti_bayar');
                $extenstion = $file->getClientOriginalExtension();
                $filename = uniqid().'.'.$extenstion;
                $file->move('assets/buktiBayar/', $filename);
                $pembayaran->bukti_bayar = $filename;
            }

            $pembayaran->save();
            // $reservasi->bayar_id = $request->input('reservasiID_bayar');
            // $reservasi->status = 'Proses Acc Admin';
            // $reservasi->update();
            return redirect()->back()->with('success','Pembayaran sudah terkirim! Silahkan tunggu konfirmasi Admin');

        } catch(\Illuminate\Database\QueryException $e){
            // Handling error duplicate
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return redirect()->back()->with('error','Pembayaran tidak valid');
            }
        }

    }
}
