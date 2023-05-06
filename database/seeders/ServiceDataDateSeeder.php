<?php

namespace Database\Seeders;

use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceDataDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $period = CarbonPeriod::create('2023-01-15', '2023-05-18');
        foreach ($period as $date) {
            DB::table('service_data_dates')->insert([
                [
                    'service_data_id' => 1,
                    'service_data_date'=> $date,
                ],
            ]);
        }
    }
}
