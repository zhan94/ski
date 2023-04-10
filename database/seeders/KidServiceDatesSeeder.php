<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KidServiceDatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($x = 1; $x <= 75; $x++) {
            for ($xs = 1; $xs <= 31; $xs++) {
                DB::table('kid_service_dates')->insert([
                    [
                        'kid_service_id' => $x,
                        'service_date' => Carbon::create('2023', '03', $xs),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ],
                ]);
            }
        }
    }
}
