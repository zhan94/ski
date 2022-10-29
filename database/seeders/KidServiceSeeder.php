<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KidServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 1; $x <= 3; $x++) {
            for ($xs = 1; $xs <= 25; $xs++) {
                DB::table('kid_services')->insert([
                    [
                        'services_data_id' => $x,
                        'kid_id' => $xs,
                        'location_id' => $x,
                        'skill_id' => 2,
                        'equip_id' => $x,
                        'card_id' => $x,
                        'service_type' => 1,
                        'sum' => 50,
                        'paid' => 40,
                        'dates' => '01-03-2021, 01-04-2021, 02-04-2021, 03-04-2021, 04-04-2021, 05-04-2021, 06-04-2021, 07-04-2021, 08-04-2021, 09-04-2021, 10-04-2021, 11-04-2021',
                        'approve' => 1,
                        'lunch' => 1,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],

                ]);
            }
        }
    }
}
