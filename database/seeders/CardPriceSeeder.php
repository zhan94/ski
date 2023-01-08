<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('card_prices')->insert([
            [
                'card_id' => 1,
                'days' => '20',
                'price' => '80'
            ],
            [
                'card_id' => 1,
                'days' => '30',
                'price' => '120'
            ],
            [
                'card_id' => 1,
                'days' => '40',
                'price' => '150'
            ]
        ]);
    }
}
