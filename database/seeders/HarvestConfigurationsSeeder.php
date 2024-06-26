<?php

namespace Database\Seeders;

use App\Models\HarvestConfiguration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HarvestConfigurationsSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    $harvest_configurations = array(
      array(
        "harvest_id" => 8,
        "section_id" => 8,
        "field_id" => 1,
        "culture_id" => 1,
        "variety_id" => 1,
        "planting_method_id" => 1,
        "organization_id" => 1,
        "planting_area" => 70450.00,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-24 21:22:03",
        "updated_at" => "2024-06-25 01:37:12",
      ),
      array(
        "harvest_id" => 8,
        "section_id" => 10,
        "field_id" => 1,
        "culture_id" => 2,
        "variety_id" => 1,
        "planting_method_id" => 1,
        "organization_id" => 1,
        "planting_area" => 16350.00,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-24 22:10:25",
        "updated_at" => "2024-06-24 22:10:25",
      ),
      array(
        "harvest_id" => 7,
        "section_id" => 11,
        "field_id" => 4,
        "culture_id" => 2,
        "variety_id" => 1,
        "planting_method_id" => 2,
        "organization_id" => 2,
        "planting_area" => 15636.00,
        "situation" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-25 01:42:00",
        "updated_at" => "2024-06-25 01:42:10",
      ),
    );

    HarvestConfiguration::insert($harvest_configurations);
  }
}
