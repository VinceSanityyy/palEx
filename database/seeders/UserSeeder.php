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
                'id' => 1, 
                'name' => 'Super Admin',
                'email' => 'palex_admin@gmail.com',
                'password' => \Hash::make('123123123'),
                'role' => 0,
                'status' => 1
                
            ],
            [
                'id' => 2, 
                'name' => 'Customer Test',
                'email' => 'c@gmail.com',
                'password' => \Hash::make('123123123'),
                'role' => 2,
                'status' => 1
            ],
            [
                'id' => 3, 
                'name' => 'Admin Pj',
                'email' => 'admin.pj@gmail.com',
                'password' => \Hash::make('password'),
                'role' => 0,
                'status' => 1
            ],
            [
                'id' => 4, 
                'name' => 'Pj Abing',
                'email' => 'pj.abing@gmail.com',
                'password' => \Hash::make('password'),
                'role' => 2,
                'status' => 1
            ]
        ];
        \DB::table('users')->insert($data);


        $data = [
            [

                'customer_id' => 2,
                'full_name' => 'Vincent Bustillo',
                'phone' => '09102626010',
                'street' => 'Street 10',
                'barangay' => 'Apokon',
                'city' => 'Tagum City',
                'province' => 'Davao del Norte',
                'selected' => 1,
            ],
            [

                'customer_id' => 4,
                'full_name' => 'Pj Leopold Abing',
                'phone' => '09387517988',
                'street' => 'Street 1',
                'barangay' => 'Apokon',
                'city' => 'Tagum City',
                'province' => 'Davao del Norte',
                'selected' => 1,
            ],

            [

                'customer_id' => 4,
                'full_name' => 'Pj Leopold Abing',
                'phone' => '09387517988',
                'street' => 'Street 10',
                'barangay' => 'Visayan Village',
                'city' => 'Tagum City',
                'province' => 'Davao del Norte',
                'selected' => 1,
            ],

            
        ];
        \DB::table('customer_addresses')->insert($data);
        
    }
}
