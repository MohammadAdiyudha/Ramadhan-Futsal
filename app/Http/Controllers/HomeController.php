<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Dashboard jadwal bisa diakses non akun
        // $this->middleware(['auth','verified']);
    }

    public function __invoke()
    {
        $events = [];

        $reservasis = Reservasi::whereNotIn('status',['Ditolak'])
                                ->get();

        foreach ($reservasis as $reservasi) {
            $events[] = [
                'title' => $reservasi->user->name,
                'start' => $reservasi->tanggal . " $reservasi->jam_awal",
                'end' => $reservasi->tanggal . " $reservasi->jam_akhir",
                'description' => $reservasi->status,
            ];
        }

        return view('home', compact('events'));
    }

}
