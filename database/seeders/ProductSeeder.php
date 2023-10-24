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
                'category_id' => 1,
                'price' => 70000,
                'stock' => 100,
                'thumbnail' => 'product1 ini keren',
                'description' => 'product1 ini hebat dan keren',
            ],
            [
                'name' => 'lemari baju',
                'category_id' => 1,
                'price' => 80000,
                'stock' => 80,
                'thumbnail' => 'product2 ini keren',
                'description' => 'product2 ini hebat dan keren',
            ],
            [
                'name' => 'kasur',
                'category_id' => 1,
                'price' => 90000,
                'stock' => 20,
                'thumbnail' => 'product3 ini keren',
                'description' => 'product3 ini hebat dan keren',
            ],
            [
                'name' => 'meja kaca',
                'category_id' => 2,
                'price' => 5000000,
                'stock' => 90,
                'thumbnail' => 'kaca tebal 1 mm, kuat tahan banting dll, ga percaya coba aja sana',
                'description' => '<ol><li>cara pemasangan ada petunjuk didalam kardus</li><li>garansi 1 tahun</li><li>jika order sudah di kurir maka bukan tanggung jawab kami</li></ol>',
            ],
        ];

        DB::table('products')->insert($product);
    }
}
