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
            [   //Pending
                'user_id' => '2',
                'bayar_id' => NULL,
                'no_hp' => '11111',
                'tanggal' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'jam_awal' => '09:00:00',
                'jam_akhir' => '10:00:00',
                'durasi' => '1',
                'harga' => '50000',
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [   //Menunggu Pembayaran
                'user_id' => '2',
                'bayar_id' => NULL,
                'no_hp' => '22222',
                'tanggal' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'jam_awal' => '11:00:00',
                'jam_akhir' => '12:00:00',
                'durasi' => '2',
                'harga' => '100000',
                'status' => 'Menunggu Pembayaran',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [   //Proses Acc Admin
                'user_id' => '2',
                'bayar_id' => '2',
                'no_hp' => '33333',
                'tanggal' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'jam_awal' => '13:00:00',
                'jam_akhir' => '15:00:00',
                'durasi' => '2',
                'harga' => '100000',
                'status' => 'Proses Acc Admin',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [   //Berhasil
                'user_id' => '2',
                'bayar_id' => '1',
                'no_hp' => '44444',
                'tanggal' => Carbon::now()->addDays(13)->format('Y-m-d'),
                'jam_awal' => '15:00:00',
                'jam_akhir' => '18:00:00',
                'durasi' => '3',
                'harga' => '150000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [   //Ditolak
                'user_id' => '2',
                'bayar_id' => NULL,
                'no_hp' => '55555',
                'tanggal' => Carbon::now()->addDays(15)->format('Y-m-d'),
                'jam_awal' => '09:00:00',
                'jam_akhir' => '10:00:00',
                'durasi' => '1',
                'harga' => '50000',
                'status' => 'Ditolak',
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
