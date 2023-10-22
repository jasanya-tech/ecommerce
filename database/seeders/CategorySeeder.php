<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'name' => 'category1',
            ],
            [
                'name' => 'category2',
            ],
            [
                'name' => 'category3',
            ],
            [
                'name' => 'category4',
            ],
        ];

        DB::table('categories')->insert($category);
    }
}
