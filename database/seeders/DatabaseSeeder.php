<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use App\Models\Vehical;
use App\Models\VehicalModel;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role' => 'admin',
        	'first_name' => 'Ritesh',
            'last_name' => 'Patel',
            'phone' => '7016590780',
        	'email' => 'admin@hvsc.com',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'role' => 'customer',
        	'first_name' => 'Ronak',
            'last_name' => 'Patel',
            'phone' => '9664725001',
        	'email' => 'user@hvsc.com',
            'password' => bcrypt('user123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'role' => 'customer',
        	'first_name' => 'Kevin',
            'last_name' => 'Rangpariya',
            'phone' => '7016587896',
        	'email' => 'user1@hvsc.com',
            'password' => bcrypt('user123'),
            'status' => 0,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        Category::create([
        	'name' => '2 Wheels',
        ]);
        Category::create([
        	'name' => '4 Wheels',
        ]);
        Brand::create([
        	'category_id' => 2,
            'name'=> 'Hundai',
            'status'=>1,
        ]);
        Brand::create([
        	'category_id' => 1,
            'name'=> 'Honda',
            'status'=>1,
        ]);
        VehicalModel::create([
        	'brand_id' => 1,
            'name'=> 'Creta',
            'status'=>1,
        ]);
        VehicalModel::create([
        	'brand_id' => 1,
            'name'=> 'i20',
            'status'=>1,
        ]);
        VehicalModel::create([
        	'brand_id' => 1,
            'name'=> 'i10',
            'status'=>1,
        ]);
        VehicalModel::create([
        	'brand_id' => 2,
            'name'=> 'Activa',
            'status'=>1,
        ]);
        VehicalModel::create([
        	'brand_id' => 2,
            'name'=> 'Dream Yuga',
            'status'=>1,
        ]);
        Vehical::create([
            'category_id' => 2,
        	'brand_id' => 1,
            'model_id' => 3,
            'title'=> 'i10 Nios',
            'year'=> 2019,
            'fuel'=> 'Petrol',
            'color'=> 'White',
            'mileage'=> '24',
            'price'=> '5.54',
            'description'=> 'Auto+CNG, Sun Roof',
            'status'=>0,
        ]);
    }
}
