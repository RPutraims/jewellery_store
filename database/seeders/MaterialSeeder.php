<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MaterialSeeder extends Seeder
{
    public function run()
    {
        DB::table('material')->insert([
            [
                'product_id' => 1,
                'material_name' => 'Gold',
                'material_description' => 'Luxurious and durable, ideal for high-end items.',
                'price_increment' => 49.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 1,
                'material_name' => 'Silver',
                'material_description' => 'Elegant and affordable with a bright finish.',
                'price_increment' => 19.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 1,
                'material_name' => 'Pearl',
                'material_description' => 'Smooth and stylish, popular for unique designs.',
                'price_increment' => 29.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 1,
                'material_name' => 'Basic',
                'material_description' => 'Standard material with no added cost.',
                'price_increment' => 0.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
