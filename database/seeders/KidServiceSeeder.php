<?php

namespace Database\Seeders;

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
            DB::table('kid_services')->insert([
                [
                    'services_data_id' => $x,
                    'service_id' => $x,
                    'kid_id' => $x,
                    'location_id' => $x,
                    'skill_id' => 2,
                    'equip_id' => $x,
                    'card_id' => $x,
                    'service_type_id' => 1,
                    'sum' => 50,
                    'paid' => 40,
                    'approve' => 1,
                    'lunch' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
        }
    }
}
