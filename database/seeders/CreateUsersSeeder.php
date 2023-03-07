<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => \Hash::make('123123123'),
                'is_admin' => true,
                'email_verified_at'=> now()
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => \Hash::make('123123123'),
                'is_admin' => false,
                'email_verified_at' => now()
            ]
        ]);
    }
}
