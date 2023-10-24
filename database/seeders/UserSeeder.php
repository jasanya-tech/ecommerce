<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            [
                'role' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'image' => 'default.jpg',
                'phone_number' => '08123456789',
                'password' => bcrypt('123'),
            ],
            [
                'role' => 2,
                'name' => 'ramaaaa',
                'email' => 'rama@gmail.com',
                'image' => 'default.jpg',
                'phone_number' => '08123456789',
                'password' => bcrypt('123'),
            ],
        ];

        DB::table('users')->insert($admin);
    }
}
