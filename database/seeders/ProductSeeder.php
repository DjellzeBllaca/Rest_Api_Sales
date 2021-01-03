<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
        DB::table('products')->insert([
            [
                'category' => 'Phone',
                'name' => 'Iphone 12',
                'barcode' => '4006381333931',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'price' => '1400',
                'status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'category' => 'Phone',
                'name' => 'Samsung Galaxy Note20 Ultra',
                'barcode' => '5006381333931',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
                'price' => '1000',
                'status' => true,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
