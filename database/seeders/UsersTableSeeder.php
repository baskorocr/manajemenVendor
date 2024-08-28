<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Example user data
        DB::table('users')->insert([
            [
                'NPK' => 11230551,
                'name' => 'baskorocr',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'is_admin' => 1,
                'password' => Hash::make('asu123ok'), // Ensure you hash the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}