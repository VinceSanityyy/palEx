<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Enums\ProductStatus;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $json = File::get("database/data/abing_products.json");
        $data = json_decode($json);
        $vendor1 =  User::create([
            'name' => 'Bing`z Fruits Stand',
            'email' => 'abing.pj@gmail.com',
            'password' => \Hash::make('password'),
            'role' => 1,
            'status' => 1
        ]);
        foreach ($data as $obj) {
            $this->createProduct($obj, $vendor1);
        }


        $json2 = File::get("database/data/vince_products.json");
        $data2 = json_decode($json2);
        $vendor2 =  User::create( [
            'name' => 'VinceSanityyy Co.',
            'email' => 'v@gmail.com',
            'password' => \Hash::make('123123123'),
            'role' => 1,
            'status' => 1
        ]);
        foreach ($data2 as $obj) {
            $this->createProduct($obj, $vendor2);
        }
    }

    public function createProduct($obj, $user)
    {
        $data = new Product;
        $data->user_id = $user->id;
        $data->name = $obj->name;
        $data->price = $obj->price;
        $data->category = $obj->category;
        $data->unit = $obj->unit;
        $data->photo = $obj->photo;
        $data->status = ProductStatus::AVAILABLE;
        $data->save();
    }
}
