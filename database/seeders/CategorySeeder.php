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
                'name' => 'BUFET',
            ],
            [
                'name' => 'DIVAN / TEMPAT TIDUR',
            ],
            [
                'name' => 'KABINET DAPUR',
            ],
            [
                'name' => 'KURSI',
            ],
            [
                'name' => 'LEMARI LACI',
            ],
            [
                'name' => 'LEMARI PAKAIAN',
            ],
            [
                'name' => 'LEMARI PAKAIAN MODULAR',
            ],
            [
                'name' => 'MEJA BELAJAR / KERJA',
            ],
            [
                'name' => 'MEJA MAKAN',
            ],
            [
                'name' => 'MEJA RIAS',
            ],
            [
                'name' => 'MEJA SAMPING / NAKAS',
            ],
            [
                'name' => 'MEJA TAMU',
            ],
            [
                'name' => 'MEJA TV / RAK TV',
            ],
            [
                'name' => 'RAK BUKU / LEMARI PAJANGAN',
            ],
            [
                'name' => 'RAK BUKU / LEMARI PAJANGAN',
            ],
            [
                'name' => 'RAK SEPATU / LEMARI SEPATU',
            ],
            [
                'name' => 'SOFA',
            ],
            [
                'name' => 'SOFABED',
            ],
        ];

        DB::table('categories')->insert($category);
    }
}
