<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skills')->insert([
            [
                'name' => 'Начинаещ',
            ],
            [
                'name' => 'Каращ',
            ],
            [
                'name' => 'Напреднал',
            ]
        ]);
    }
}
