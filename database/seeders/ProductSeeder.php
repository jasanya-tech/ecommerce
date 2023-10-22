<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
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
                'name' => 'kayu batangan',
                'price' => 70000,
                'stock' => 100,
                'thumbnail' => 'product1 ini keren',
                'description' => 'product1 ini hebat dan keren',
            ],
            [
                'name' => 'lemari baju',
                'price' => 80000,
                'stock' => 80,
                'thumbnail' => 'product2 ini keren',
                'description' => 'product2 ini hebat dan keren',
            ],
            [
                'name' => 'kasur',
                'price' => 90000,
                'stock' => 20,
                'thumbnail' => 'product3 ini keren',
                'description' => 'product3 ini hebat dan keren',
            ],
            [
                'name' => 'teriplek',
                'price' => 100000,
                'stock' => 90,
                'thumbnail' => 'product4 ini keren',
                'description' => 'product4 ini hebat dan keren',
            ],
        ];

        DB::table('products')->insert($product);
    }
}
