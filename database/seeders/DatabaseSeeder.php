<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        $this->call(ServiceDataSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(EquipSeeder::class);
        $this->call(EquipPriceSeeder::class);
        $this->call(CardSeeder::class);
        $this->call(CardPriceSeeder::class);
        $this->call(KidSeeder::class);
        $this->call(KidServiceSeeder::class);
        $this->call(AdditionalServiceSeeder::class);
        $this->call(AdditionalServicePriceSeeder::class);
        $this->call(NavBarSeeder::class);
        User::factory()->create();
    }
}
