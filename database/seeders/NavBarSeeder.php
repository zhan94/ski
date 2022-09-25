<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavBarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navbars')->insert([
            [
                'name' => 'Услуги',
                'route' => 'services',
                'ordering' => 1,
            ],
            [
                'name' => 'Въведи дете',
                'route' => 'services',
                'ordering' => 2,
            ],
            [
                'name' => 'Потребители',
                'route' => 'users',
                'ordering' => 3,
            ],
            [
                'name' => 'Местоположения',
                'route' => 'locations',
                'ordering' => 4,
            ],
            [
                'name' => 'Справки',
                'route' => 'reports',
                'ordering' => 5,
            ],
            [
                'name' => 'Карти',
                'route' => 'cards',
                'ordering' => 6,
            ],
            [
                'name' => 'Екипировки',
                'route' => 'equips',
                'ordering' => 7,
            ],
            [
                'name' => 'База данни',
                'route' => 'kids',
                'ordering' => 8,
            ],
            [
                'name' => 'Допълнителни Занятия',
                'route' => 'additional_service',
                'ordering' => 9,
            ]
        ]);
    }
}
