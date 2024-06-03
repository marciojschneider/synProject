<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
  public function run(): void {
    $this->call(ClientsSeeder::class);
    $this->call(ProfilesSeeder::class);
    $this->call(SidebarsSeeder::class);
    $this->call(HarvestSeeder::class);
    $this->call(CulturesSeeder::class);
    $this->call(PlantingMethodsSeeder::class);
    $this->call(ProcessSeeder::class);
  }
}
