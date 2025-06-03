<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminSeed extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            'name' => 'Admin User',
            'person_code' => '123456-78901',
            'phone_number' => '+37120000000',
            'email' => 'admin@example.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('adminpassword'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
