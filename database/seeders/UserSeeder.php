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
        $data = [
            [
                'name' => 'Super Admin',
                'email' => 'palex_admin@gmail.com',
                'password' => \Hash::make('123123123'),
                'role' => 0,
                'status' => 1
            ],
            [
                'name' => 'Customer Test',
                'email' => 'c@gmail.com',
                'password' => \Hash::make('123123123'),
                'role' => 2,
                'status' => 1
            ],
            [
                'name' => 'Vendor Test',
                'email' => 'v@gmail.com',
                'password' => \Hash::make('123123123'),
                'role' => 1,
                'status' => 1
            ],
            [
                'name' => 'Admin Pj',
                'email' => 'admin.pj@gmail.com',
                'password' => \Hash::make('password'),
                'role' => 0,
                'status' => 1
            ],
            [
                'name' => 'Abing Pj Store',
                'email' => 'abing.pj@gmail.com',
                'password' => \Hash::make('password'),
                'role' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pj Abing',
                'email' => 'pj.abing@gmail.com',
                'password' => \Hash::make('password'),
                'role' => 2,
                'status' => 1
            ]
        ];
        \DB::table('users')->insert($data);
    }
}
