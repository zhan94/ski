<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ServiceSeeder::class);
        $this->call(ServiceDateSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(EquipSeeder::class);
        $this->call(EquipPriceSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(CardPriceSeeder::class);
    }
}
