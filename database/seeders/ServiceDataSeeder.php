<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services_data')->insert([

            [
                'service_id' => 1,
                'dates' => '26-12-2020, 27-12-2020, 28-12-2020, 29-12-2020, 30-12-2020, 04-01-2021, 05-01-2021, 06-01-2021, 07-01-2021, 08-01-2021, 09-01-2021, 10-01-2021, 11-01-2021, 12-01-2021, 13-01-2021, 14-01-2021, 15-01-2021, 16-01-2021, 17-01-2021, 18-01-2021',
                'max' => 25,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'service_id' => 1,
                'dates' => '21-03-2021, 22-03-2021, 23-03-2021, 24-03-2021, 25-03-2021, 26-03-2021, 27-03-2021, 28-03-2021, 29-03-2021, 30-03-2021, 31-03-2021, 01-04-2021, 02-04-2021, 03-04-2021, 04-04-2021, 05-04-2021, 06-04-2021, 07-04-2021, 08-04-2021, 09-04-2021, 10-04-2021, 11-04-2021',
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
