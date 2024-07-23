<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
  public function run(): void {
    $this->call(SidebarsSeeder::class);
    $this->call(ClientsSeeder::class);
    $this->call(UsersSeeder::class);
    $this->call(ProfilesSeeder::class);
    $this->call(UserProfilesSeeder::class);
    $this->call(ProfilePermissionsSeeder::class);
    $this->call(TasksSeeder::class);
    $this->call(TaskDetailsSeeder::class);
    // $this->call(OrganizationsSeeder::class);
    // $this->call(CulturesSeeder::class);
    // $this->call(FarmsSeeder::class);
    // $this->call(LocalitiesSeeder::class);
    // $this->call(FieldsSeeder::class);
    // $this->call(SectorsSeeder::class);
    // $this->call(SectionsSeeder::class);
    // $this->call(GroupsSeeder::class);
    // $this->call(VarietiesSeeder::class);
    // $this->call(HarvestSeeder::class);
    // $this->call(CulturesSeeder::class);
    // $this->call(PlantingMethodsSeeder::class);
    // $this->call(ProcessSeeder::class);
    // $this->call(ClosureModulesSeeder::class);
    // $this->call(HarvestConfigurationsSeeder::class);
  }
}
