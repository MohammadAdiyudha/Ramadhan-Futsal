<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ReservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('reservasis')->insert([
            // USER ID 1 - Bukan Dummy
            [   //Menunggu Pembayaran 1
                'user_id' => '2',
                'no_hp' => '111111111111',
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'jam_awal' => '11:00:00',
                'jam_akhir' => '15:00:00',
                'durasi' => '4',
                'harga' => '440000',
                'status' => 'Menunggu Pembayaran',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [   //Menunggu Pembayaran 2
                'user_id' => '2',
                'no_hp' => '222222222222',
                'tanggal' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'jam_awal' => '11:00:00',
                'jam_akhir' => '12:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Menunggu Pembayaran',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [   //Proses Acc Admin
                'user_id' => '2',
                'no_hp' => '333333333333',
                'tanggal' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'jam_awal' => '13:00:00',
                'jam_akhir' => '15:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Proses Acc Admin',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [   //Berhasil
                'user_id' => '2',
                'no_hp' => '44444444444',
                'tanggal' => Carbon::now()->addDays(13)->format('Y-m-d'),
                'jam_awal' => '15:00:00',
                'jam_akhir' => '18:00:00',
                'durasi' => '3',
                'harga' => '330000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [   //Ditolak
                'user_id' => '2',
                'no_hp' => '55555555555',
                'tanggal' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'jam_awal' => '09:00:00',
                'jam_akhir' => '10:00:00',
                'durasi' => '1',
                'harga' => '110000',
                'status' => 'Ditolak',
                'created_at' => now(),
                'updated_at' => now(),

            ],

            [   //Menunggu Pembayaran 3
                'user_id' => '2',
                'no_hp' => '121212121212',
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'jam_awal' => '18:00:00',
                'jam_akhir' => '20:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Menunggu Pembayaran',
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
