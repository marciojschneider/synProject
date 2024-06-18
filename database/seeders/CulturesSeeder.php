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
        "name" => "ARROZ",
        "created_at" => "2024-06-03 22:13:28",
        "updated_at" => "2024-06-17 18:29:38",
        "creation_user" => 1,
        "client_id" => 1,
      ),
      array(
        "code" => "02",
        "name" => "SOJA",
        "created_at" => "2024-06-03 22:13:40",
        "updated_at" => "2024-06-17 18:29:46",
        "creation_user" => 1,
        "client_id" => 1,
      ),
      array(
        "code" => "03",
        "name" => "MIRTILO",
        "created_at" => "2024-06-03 22:13:47",
        "updated_at" => "2024-06-17 18:29:51",
        "creation_user" => 1,
        "client_id" => 1,
      ),
      array(
        "code" => "04",
        "name" => "PASTAGEM",
        "created_at" => "2024-06-03 22:13:56",
        "updated_at" => "2024-06-17 18:29:54",
        "creation_user" => 1,
        "client_id" => 1,
      ),
      array(
        "code" => "88",
        "name" => "DIVERSOS",
        "created_at" => "2024-06-03 22:14:04",
        "updated_at" => "2024-06-17 18:29:57",
        "creation_user" => 1,
        "client_id" => 1,
      ),
    );

    Culture::insert($cultures);
  }
}
