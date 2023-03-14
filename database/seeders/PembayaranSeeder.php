<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pembayarans')->insert([
            [
                'reservasi_id' => '3',
                'atas_nama' => 'Subejo',
                'jenis_bayar' => 'Mandiri',
                'bukti_bayar' => 'tes.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'reservasi_id' => '4',
                'atas_nama' => 'Yuyu',
                'jenis_bayar' => 'Shopeepay',
                'bukti_bayar' => 'tes.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
    }
}
