<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('equip_prices')->insert([
            [
                'equip_id' => 1,
                'days' => '1',
                'price' => '60'
            ],
            [
                'equip_id' => 1,
                'days' => '2',
                'price' => '110'
            ],
            [
                'equip_id' => 1,
                'days' => '3',
                'price' => '155'
            ]
        ]);
    }
}
