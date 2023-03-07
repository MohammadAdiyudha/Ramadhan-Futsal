<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class dummyAccSeeder extends Seeder
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
                'name' => 'Admin Dummy 1',
                'email' => 'admin1@gmail.com',
                'password' => \Hash::make('123123123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin Dummy 2',
                'email' => 'admin2@gmail.com',
                'password' => \Hash::make('123123123'),
                'is_admin' => true,
            ],

            [
                'name' => 'User Dummy 1',
                'email' => 'user1@gmail.com',
                'password' => \Hash::make('123123123'),
                'is_admin' => false,
            ],
            [
                'name' => 'User Dummy 2',
                'email' => 'user2@gmail.com',
                'password' => \Hash::make('123123123'),
                'is_admin' => false,
            ],
            [
                'name' => 'User Dummy 3',
                'email' => 'user3@gmail.com',
                'password' => \Hash::make('123123123'),
                'is_admin' => false,
            ],
        ]);
    }
}
