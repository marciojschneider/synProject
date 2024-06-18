<?php

namespace Database\Seeders;

use App\Models\Locality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalitiesSeeder extends Seeder {
  public function run(): void {
    $localities = array(
      array(
        "code" => "02",
        "name" => "ALFEU",
        "situation" => 1,
        "created_at" => "2024-06-13 21:28:37",
        "updated_at" => "2024-06-17 20:22:47",
      ),
      array(
        "code" => "03",
        "name" => "CAMPO NOVO",
        "situation" => 1,
        "created_at" => "2024-06-13 21:28:44",
        "updated_at" => "2024-06-17 20:22:50",
      ),
      array(
        "code" => "04",
        "name" => "JUNCAL",
        "situation" => 1,
        "created_at" => "2024-06-13 21:28:50",
        "updated_at" => "2024-06-17 20:22:53",
      ),
      array(
        "code" => "05",
        "name" => "TEREZA",
        "situation" => 1,
        "created_at" => "2024-06-18 00:33:43",
        "updated_at" => "2024-06-18 00:33:43",
      ),
      array(
        "code" => "06",
        "name" => "AÇUDE",
        "situation" => 1,
        "created_at" => "2024-06-18 00:33:51",
        "updated_at" => "2024-06-18 00:33:51",
      ),
      array(
        "code" => "07",
        "name" => "ALEXANDRE",
        "situation" => 1,
        "created_at" => "2024-06-18 00:34:02",
        "updated_at" => "2024-06-18 00:34:02",
      ),
      array(
        "code" => "08",
        "name" => "HERNANDORENA",
        "situation" => 1,
        "created_at" => "2024-06-18 00:34:21",
        "updated_at" => "2024-06-18 00:34:21",
      ),
      array(
        "code" => "09",
        "name" => "VINICIUS",
        "situation" => 1,
        "created_at" => "2024-06-18 00:34:28",
        "updated_at" => "2024-06-18 00:34:28",
      ),
      array(
        "code" => "10",
        "name" => "DIEGO",
        "situation" => 1,
        "created_at" => "2024-06-18 00:34:36",
        "updated_at" => "2024-06-18 00:34:36",
      ),
      array(
        "code" => "11",
        "name" => "CORÉIA",
        "situation" => 1,
        "created_at" => "2024-06-18 00:34:44",
        "updated_at" => "2024-06-18 00:34:44",
      ),
      array(
        "code" => "12",
        "name" => "RESTEVA NOVA",
        "situation" => 1,
        "created_at" => "2024-06-18 00:34:56",
        "updated_at" => "2024-06-18 00:34:56",
      ),
      array(
        "code" => "13",
        "name" => "BARDALLO E PENHA",
        "situation" => 1,
        "created_at" => "2024-06-18 00:35:02",
        "updated_at" => "2024-06-18 00:35:02",
      ),
      array(
        "code" => "15",
        "name" => "PIUMAS",
        "situation" => 1,
        "created_at" => "2024-06-18 00:35:17",
        "updated_at" => "2024-06-18 00:35:17",
      ),
      array(
        "code" => "14",
        "name" => "LUIZ ANTÔNIO",
        "situation" => 1,
        "created_at" => "2024-06-18 00:35:36",
        "updated_at" => "2024-06-18 00:35:36",
      ),
    );

    Locality::insert($localities);
  }
}
