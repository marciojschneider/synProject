<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorsSeeder extends Seeder {
  public function run(): void {
    $sectors = array(
      array(
        "code" => "01",
        "name" => "JOSÉ LUIZ",
        "farm_id" => 12,
        "situation" => 1,
        "created_at" => "2024-06-14 05:12:18",
        "updated_at" => "2024-06-17 20:22:05",
      ),
      array(
        "code" => "02",
        "name" => "MILTON PELLENS",
        "farm_id" => 12,
        "situation" => 1,
        "created_at" => "2024-06-14 05:12:29",
        "updated_at" => "2024-06-17 20:22:09",
      ),
      array(
        "code" => "03",
        "name" => "SALVADOR MARTINS",
        "farm_id" => 12,
        "situation" => 1,
        "created_at" => "2024-06-14 05:12:39",
        "updated_at" => "2024-06-17 20:22:12",
      ),
    );

    Sector::insert($sectors);
  }
}
