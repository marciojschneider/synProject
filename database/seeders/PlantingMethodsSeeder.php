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
        "name" => "CONVENCIONAL",
        "situation" => 1,
        "created_at" => "2024-06-03 22:14:25",
        "updated_at" => "2024-06-17 18:30:02",
      ),
      array(
        "code" => "02",
        "name" => "DIRETO",
        "situation" => 1,
        "created_at" => "2024-06-03 22:14:33",
        "updated_at" => "2024-06-17 18:30:05",
      ),
      array(
        "code" => "03",
        "name" => "MÍNIMO",
        "situation" => 1,
        "created_at" => "2024-06-03 22:14:42",
        "updated_at" => "2024-06-17 18:30:11",
      ),
      array(
        "code" => "88",
        "name" => "A DEFINIR",
        "situation" => 1,
        "created_at" => "2024-06-03 22:14:51",
        "updated_at" => "2024-06-17 18:30:50",
      ),
    );

    PlantingMethod::insert($planting_methods);
  }
}
