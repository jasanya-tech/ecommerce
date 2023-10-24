<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            [
                'name' => "bca",
                'no_rek' => '12345678',
            ],
            [
                'name' => 'mandiri',
                'no_rek' => '87654321',
            ],
        ];

        DB::table('payments')->insert($payments);
    }
}
