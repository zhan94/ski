<?php

namespace Database\Seeders;

use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KidServiceDatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $period = CarbonPeriod::create('2023-05-15', '2023-05-17');
        foreach ($period as $date) {
            DB::table('kid_service_dates')->insert([
                [
                    'kid_service_id' => 1,
                    'kid_service_date' => $date
                ],
            ]);
        }
    }
}
