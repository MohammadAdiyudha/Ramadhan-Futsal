<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id('bayar_id');
            $table->foreignId('reservasi_id');
            $table->string('atas_nama');
            $table->string('jenis_bayar');
            $table->string('bukti_bayar');
            $table->timestamps();

            $table->foreign('reservasi_id')->references('reservasi_id')->on('reservasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
