<?php

namespace Database\Seeders;

use App\Models\Culture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CulturesSeeder extends Seeder {
  public function run(): void {
    $cultures = array(
      array(
        "code" => "01",
        "name" => "Arroz",
        "created_at" => "2024-06-03 22:13:28",
        "updated_at" => "2024-06-03 22:13:28",
      ),
      array(
        "code" => "02",
        "name" => "Soja",
        "created_at" => "2024-06-03 22:13:40",
        "updated_at" => "2024-06-03 22:13:40",
      ),
      array(
        "code" => "03",
        "name" => "Mirtilo",
        "created_at" => "2024-06-03 22:13:47",
        "updated_at" => "2024-06-03 22:13:47",
      ),
      array(
        "code" => "04",
        "name" => "Pastagem",
        "created_at" => "2024-06-03 22:13:56",
        "updated_at" => "2024-06-03 22:13:56",
      ),
      array(
        "code" => "88",
        "name" => "Diversos",
        "created_at" => "2024-06-03 22:14:04",
        "updated_at" => "2024-06-03 22:14:04",
      ),
    );

    Culture::insert($cultures);
  }
}
