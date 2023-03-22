<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        \DB::table('reservasis')->insert([
            // 2 Hari Mundur
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'jam_awal' => '09:00:00',
                'jam_akhir' => '11:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'jam_awal' => '12:00:00',
                'jam_akhir' => '14:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],

            // Kemarin
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'jam_awal' => '10:00:00',
                'jam_akhir' => '12:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'jam_awal' => '18:00:00',
                'jam_akhir' => '20:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],

            // Besok
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'jam_awal' => '09:00:00',
                'jam_akhir' => '11:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'jam_awal' => '13:00:00',
                'jam_akhir' => '15:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'jam_awal' => '19:00:00',
                'jam_akhir' => '21:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],

            // Lusa
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'jam_awal' => '13:00:00',
                'jam_akhir' => '15:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'jam_awal' => '19:00:00',
                'jam_akhir' => '21:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],

            // Besok Lusa
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'jam_awal' => '09:00:00',
                'jam_akhir' => '11:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'jam_awal' => '11:00:00',
                'jam_akhir' => '13:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'user_id' => $faker->randomElement([5, 6]),
                'no_hp' => $faker->numerify('############'),
                'tanggal' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'jam_awal' => '14:00:00',
                'jam_akhir' => '16:00:00',
                'durasi' => '2',
                'harga' => '220000',
                'status' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
