<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->insert([
            [
                'category_name' => "Men's Chains",
                'category_description' => 'Stylish and masculine necklaces designed for men.',
            ],
            [
                'category_name' => "Women's Necklaces",
                'category_description' => 'Elegant and customizable necklaces for women.',
            ],
            [
                'category_name' => "Men's Bracelets",
                'category_description' => 'Bold bracelets crafted with masculine style.',
            ],
            [
                'category_name' => "Women's Bracelets",
                'category_description' => 'Graceful bracelets perfect for any outfit.',
            ],
            [
                'category_name' => "Men's Rings",
                'category_description' => 'Durable and bold rings made for men.',
            ],
            [
                'category_name' => "Women's Rings",
                'category_description' => 'Detailed and elegant rings designed for women.',
            ],
            [
                'category_name' => "Men's Earrings",
                'category_description' => "Men's earrings for every occasion.",
            ],
            [
                'category_name' => "Women's Earrings",
                'category_description' => "Stylish earrings for every occasion.",
            ],
        ]);
    }
}
