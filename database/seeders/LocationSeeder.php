<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 3; $x++) {
            DB::table('locations')->insert([
                [
                    'service_id' => $x,
                    'pick_up_place' => 'ХИТ',
                    'drop_down_place' => 'ХИТ',
                    'pick_up_time' => '8:00',
                    'drop_down_time' => '16.45',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'service_id' => $x,
                    'pick_up_place' => 'НДК',
                    'drop_down_place' => 'НДК',
                    'pick_up_time' => '8:00',
                    'drop_down_time' => '16.45',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'service_id' => $x,
                    'pick_up_place' => 'Бояна',
                    'drop_down_place' => 'Бояна',
                    'pick_up_time' => '8:00',
                    'drop_down_time' => '16.45',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
        }
    }
}
