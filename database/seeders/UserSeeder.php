<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'palex_admin@gmail.com',
            'password' => \Hash::make('123123123'),
            'role' => 0,
            'status' => 1
        ]);
    }
}
