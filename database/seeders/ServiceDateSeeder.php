<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_dates')->insert([

            [
                'service_id' => 1,
                'dates' => '01-03-2021, 01-04-2021, 02-04-2021, 03-04-2021, 04-04-2021, 05-04-2021, 06-04-2021, 07-04-2021, 08-04-2021, 09-04-2021, 10-04-2021, 11-04-2021',
                'max' => 25,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 2,
                'dates' => ' 18-08-2020, 19-08-2020, 20-08-2020, 21-08-2020, 24-08-2020, 25-08-2020, 26-08-2020, 27-08-2020, 28-08-2020, 31-08-2020',
                'max' => 25,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 3,
                'dates' => ' 02-04-2021, 03-04-2021, 04-04-2021, 05-04-2021, 06-04-2021, 07-04-2021, 08-04-2021, 09-04-2021, 10-04-2021, 11-04-2021',
                'max' => 25,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);
    }
}
