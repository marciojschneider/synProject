<?php

namespace Database\Seeders;

use App\Models\PlantingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlantingMethodsSeeder extends Seeder {
  public function run(): void {
    $planting_methods = array(
      array(
        "code" => "01",
        "name" => "Convencional",
        "situation" => 1,
        "created_at" => "2024-06-03 22:14:25",
        "updated_at" => "2024-06-03 22:14:25",
      ),
      array(
        "code" => "02",
        "name" => "Direto",
        "situation" => 1,
        "created_at" => "2024-06-03 22:14:33",
        "updated_at" => "2024-06-03 22:14:33",
      ),
      array(
        "code" => "03",
        "name" => "Mínimo",
        "situation" => 1,
        "created_at" => "2024-06-03 22:14:42",
        "updated_at" => "2024-06-03 22:14:42",
      ),
      array(
        "code" => "88",
        "name" => "A definir",
        "situation" => 1,
        "created_at" => "2024-06-03 22:14:51",
        "updated_at" => "2024-06-03 22:14:51",
      ),
    );

    PlantingMethod::insert($planting_methods);
  }
}
