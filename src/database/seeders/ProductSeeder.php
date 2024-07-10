<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('products')->truncate();

        DB::table('products')->insert([
            [
                'image' => 'bun_sweet_potato.Jpg',
                'name' => 'Burp Mini Bun (Sweet Potato)',
                'category' => 'Dog',
                'price' => '5.50',
            ],

            [
                'image' => 'bun_ori.Jpg',
                'name' => 'Burp Mini Bun (Original)',
                'category' => 'Dog',
                'price' => '11.00',
            ],

            [
                'image' => 'bun_chicken.Jpg',
                'name' => 'Burp Mini Bun (Chicken)',
                'category' => 'Dog',
                'price' => '27.50',
            ],

            [
                'image' => 'dogFood.webp',
                'name' => 'Zenith Dog Food',
                'category' => 'Dog',
                'price' => '49.99',
            ],

            [
                'image' => 'smart_bone.avif',
                'name' => 'Smartbones Double Time Chews 3 Medium',
                'category' => 'Dog',
                'price' => '35.60',
            ],

            [
                'image' => 'dogcans.jpg',
                'name' => 'Dog Can',
                'category' => 'Dog',
                'price' => '35.60',
            ],

            [
                'image' => '81amc1cWs0L._AC_SL1500_.jpg',
                'name' => 'Cat Bed Medium',
                'category' => 'Cat',
                'price' => '45.90',
            ],

            [
                'image' => 'bird_food.png',
                'name' => 'MILLET MIX BIRD FOOD 1KG',
                'category' => 'Bird',
                'price' => '11.88',
            ],

            [
                'image' => 'Food_Goldfish.png',
                'name' => 'Tetra Complete Food for Goldfish',
                'category' => 'Aqua',
                'price' => '15.58',
            ],
        ]);
    }
}
