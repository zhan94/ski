<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdditionalServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('additional_services')->insert([
            [
                'name' => 'Плувен лагер',
                'pick_up_place' => 'Национален исторически музей Бояна',
                'drop_down_place' => 'Национален исторически музей Бояна',
                'from_date' => '24-08-2020',
                'to_date' => '28-08-2020',
                'description' => '5.1. Плувен лагер за напреднали и начинаещи',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Зимен  лагер',
                'pick_up_place' => 'Национален исторически музей Бояна',
                'drop_down_place' => 'Национален исторически музей Бояна',
                'from_date' => '26-11-2020',
                'to_date' => '30-12-2020',
                'description' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
