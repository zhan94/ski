<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalServicePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('additional_service_prices')->insert([
            [
                'service_id' => 1,
                'day' => '5',
                'price' => '360'
            ],
            [
                'service_id' => 2,
                'day' => '5',
                'price' => '440'
            ]
        ]);
    }
}
