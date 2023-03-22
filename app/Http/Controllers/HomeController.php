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
        $this->middleware(['auth','verified']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the ADMIN dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.adminHome');
    }

    public function __invoke()
    {
        $events = [];

        $reservasis = Reservasi::whereNotIn('status',['Menunggu Pembayaran','Ditolak'])
                                ->get();

        foreach ($reservasis as $reservasi) {
            $events[] = [
                'title' => $reservasi->user->name,
                'start' => $reservasi->tanggal . " $reservasi->jam_awal",
                'end' => $reservasi->tanggal . " $reservasi->jam_akhir",
                'description' => $reservasi->status,
            ];
        }

        if(Auth::user()->is_admin==1) {
            return view('admin.adminHome', compact('events'));
        } else {
            return view('home', compact('events'));
        }
    }

}
