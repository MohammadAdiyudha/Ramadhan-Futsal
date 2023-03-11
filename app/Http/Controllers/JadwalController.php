<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;

class JadwalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    // Untuk memanggil otomatis Full Calendar
    public function __invoke()
    {
        $events = [];

        $reservasis = Reservasi::where('status','Berhasil')
                                ->get();

        foreach ($reservasis as $reservasi) {
            $events[] = [
                'title' => 'Booked',
                'start' => $reservasi->tanggal . " $reservasi->jam_awal",
                'end' => $reservasi->tanggal . " $reservasi->jam_akhir",
            ];
        }

        return view('jadwal', compact('events'));
        // Debug array cek isi dd($events);
    }
}