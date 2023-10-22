<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'product_id' => 1,
                'image' => 'default.jpg',
            ],
            [
                'product_id' => 2,
                'image' => 'default.jpg',
            ],
            [
                'product_id' => 3,
                'image' => 'default.jpg',
            ],
            [
                'product_id' => 4,
                'image' => 'default.jpg',
            ],
            [
                'product_id' => 4,
                'image' => 'default.jpg',
            ],
            [
                'product_id' => 4,
                'image' => 'default.jpg',
            ],
        ];

        DB::table('image_product')->insert($product);
    }
}
