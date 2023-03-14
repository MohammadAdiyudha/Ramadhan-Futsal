<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Reservasi extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "reservasis";
    protected $fillable = [
        'no_hp',
        'tanggal',
        'jam_awal',
        'jam_akhir',
        'durasi',
        'harga',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'reservasi_id';
    public function pembayaran()
    {
    	return $this->hasOne(Pembayaran::class,'reservasi_id');
    }
}
