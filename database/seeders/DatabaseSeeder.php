<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CreateUsersSeeder::class);
        $this->call(dummyAccSeeder::class);
        $this->call(ReservasiSeeder::class);
        $this->call(PembayaranSeeder::class);
        // $this->call(FakerSeeder::class);
    }
}
