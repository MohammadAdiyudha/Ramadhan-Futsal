<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pembayaran extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "pembayarans";
    protected $fillable = [
        'atas_nama',
        'jenis_bayar',
        'bukti_bayar',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'bayar_id';
    public function reservasi()
    {
    	return $this->belongsTo(Reservasi::class,'reservasi_id');
    }
}
