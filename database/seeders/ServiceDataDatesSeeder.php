<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceDataDatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dates = $this->generateDateRange();
        foreach ($dates as $date) {
            DB::table('service_data_dates')->insert([
                [
                    'service_data_id' => 1,
                    'service_date' => $date,
                ],
                [
                    'service_data_id' => 2,
                    'service_date' => $date,
                ],
                [
                    'service_data_id' => 2,
                    'service_date' => $date,
                ]
            ]);
        }
    }

    private function generateDateRange(): array
    {
        $start_date = Carbon::create('2023', '04', '01');
        $end_date = Carbon::create('2023', '04', '30');
        $dates = [];

        for ($date = $start_date->copy(); $date->lte($end_date); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;
    }
}
