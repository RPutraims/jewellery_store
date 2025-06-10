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
                'material_name' => 'Gold',
                'material_description' => 'Luxurious and durable, ideal for high-end items.',
                'price_increment' => 49.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Silver',
                'material_description' => 'Elegant and affordable with a bright finish.',
                'price_increment' => 19.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Pearl',
                'material_description' => 'Smooth and stylish, popular for unique designs.',
                'price_increment' => 29.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Basic',
                'material_description' => 'Standard material with no added cost.',
                'price_increment' => 0.00,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Rose Gold',
                'material_description' => 'Romantic pink-tinted gold with a warm, feminine appeal.',
                'price_increment' => 54.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'White Gold',
                'material_description' => 'Modern alternative to platinum with a sleek silver appearance.',
                'price_increment' => 44.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Platinum',
                'material_description' => 'Premium white metal, hypoallergenic and extremely durable.',
                'price_increment' => 89.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Sterling Silver',
                'material_description' => 'High-quality silver alloy with 92.5% pure silver content.',
                'price_increment' => 24.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Stainless Steel',
                'material_description' => 'Durable, tarnish-resistant, and affordable modern option.',
                'price_increment' => 9.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Titanium',
                'material_description' => 'Lightweight, strong, and hypoallergenic contemporary metal.',
                'price_increment' => 34.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Copper',
                'material_description' => 'Warm reddish metal with artisan appeal and antimicrobial properties.',
                'price_increment' => 12.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Brass',
                'material_description' => 'Golden-colored alloy with vintage charm and affordability.',
                'price_increment' => 8.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Bronze',
                'material_description' => 'Rich brown metal with ancient heritage and unique patina.',
                'price_increment' => 14.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Palladium',
                'material_description' => 'Platinum-group metal with natural white luster and durability.',
                'price_increment' => 69.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Rhodium Plated',
                'material_description' => 'Ultra-bright finish that enhances shine and prevents tarnishing.',
                'price_increment' => 39.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Black Titanium',
                'material_description' => 'Sleek dark finish with modern appeal and scratch resistance.',
                'price_increment' => 44.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Tungsten',
                'material_description' => 'Extremely durable and scratch-resistant with permanent polish.',
                'price_increment' => 29.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Cobalt',
                'material_description' => 'Bright white metal that maintains its color without plating.',
                'price_increment' => 32.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Carbon Fiber',
                'material_description' => 'Lightweight modern material with distinctive woven pattern.',
                'price_increment' => 24.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Ceramic',
                'material_description' => 'Smooth, scratch-resistant material available in various colors.',
                'price_increment' => 22.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Wood',
                'material_description' => 'Natural organic material offering unique grain patterns.',
                'price_increment' => 16.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Leather',
                'material_description' => 'Classic natural material perfect for bracelets and watch bands.',
                'price_increment' => 18.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Silicone',
                'material_description' => 'Flexible, comfortable, and waterproof modern material.',
                'price_increment' => 7.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Rubber',
                'material_description' => 'Durable and sporty material ideal for active lifestyles.',
                'price_increment' => 6.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Resin',
                'material_description' => 'Versatile synthetic material available in vibrant colors.',
                'price_increment' => 11.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Acrylic',
                'material_description' => 'Clear or colorful plastic material with modern aesthetic.',
                'price_increment' => 9.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Hemp',
                'material_description' => 'Eco-friendly natural fiber perfect for casual, bohemian styles.',
                'price_increment' => 5.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Cord',
                'material_description' => 'Adjustable fabric material ideal for friendship bracelets.',
                'price_increment' => 4.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Nylon',
                'material_description' => 'Strong synthetic material with excellent durability.',
                'price_increment' => 8.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'material_name' => 'Mesh',
                'material_description' => 'Flexible woven metal design offering comfort and style.',
                'price_increment' => 21.99,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
