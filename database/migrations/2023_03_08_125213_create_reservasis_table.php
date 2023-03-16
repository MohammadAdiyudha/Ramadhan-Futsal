<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id('reservasi_id');
            $table->foreignId('user_id');
            $table->string('no_hp');
            $table->date('tanggal');
            $table->time('jam_awal')->nullable();
            $table->time('jam_akhir')->nullable();
            $table->integer('durasi')->nullable();
            $table->biginteger('harga')->nullable();
            $table->string('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasis');
    }
}
