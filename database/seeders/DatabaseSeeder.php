<?php

namespace Database\Seeders;

use App\Models\User;
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
        	'first_name' => 'Administrator',
            'last_name' => '',
        	'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
    }
}
