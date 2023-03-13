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

        try {
            // Proses Insert ke Table pembayarans
            $pembayaran = new Pembayaran;
            $pembayaran->reservasi_id = $request->input('reservasiID_bayar');
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

            // Proses Update ke Table reservasis
            if(!is_null($pembayaran)) {
                $reservasi = Reservasi::find($request->input('reservasiID_bayar'));
                $reservasi->status = 'Proses Acc Admin';
                $reservasi->update();
            }
            return redirect()->back()->with('success','Pembayaran sudah terkirim! Silahkan tunggu konfirmasi Admin');

        } catch(\Illuminate\Database\QueryException $e){
            // Handling error duplicate
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return redirect()->back()->with('error','Pembayaran tidak valid');
            }
        }

    }

    public function lihatBayar($id)
    {
        $pembayaran   = DB::table('pembayarans')
                        ->where('reservasi_id','=',$id)
                        ->first();
        return view('lihatBayar')->with('pembayaran', $pembayaran);

    }
}
