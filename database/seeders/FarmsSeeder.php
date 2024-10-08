<?php

namespace Database\Seeders;

use App\Models\Farm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmsSeeder extends Seeder {
  public function run(): void {
    $farms = array(
      array(
        "code" => "02",
        "name" => "ALFEU",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:42:04",
        "updated_at" => "2024-06-21 21:03:51",
      ),
      array(
        "code" => "03",
        "name" => "CAMPO NOVO",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:42:20",
        "updated_at" => "2024-06-17 20:20:59",
      ),
      array(
        "code" => "04",
        "name" => "JUNCAL",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:42:42",
        "updated_at" => "2024-06-17 20:21:03",
      ),
      array(
        "code" => "05",
        "name" => "TEREZA",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:42:53",
        "updated_at" => "2024-06-17 20:21:07",
      ),
      array(
        "code" => "06",
        "name" => "AÇUDE",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:45:07",
        "updated_at" => "2024-06-17 20:21:15",
      ),
      array(
        "code" => "07",
        "name" => "ALEXANDRE",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:45:44",
        "updated_at" => "2024-06-17 20:21:20",
      ),
      array(
        "code" => "08",
        "name" => "HERNANDORENA",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:46:02",
        "updated_at" => "2024-06-17 20:21:24",
      ),
      array(
        "code" => "6031",
        "name" => "CELSO FEIJÓ",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:46:27",
        "updated_at" => "2024-06-17 20:21:31",
      ),
      array(
        "code" => "6032",
        "name" => "SERGIO CARDOSO",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 15:46:42",
        "updated_at" => "2024-06-17 20:21:34",
      ),
      array(
        "code" => "09",
        "name" => "VINICIUS",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 16:10:31",
        "updated_at" => "2024-06-17 20:21:39",
      ),
      array(
        "code" => "10",
        "name" => "DIEGO",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-10 16:10:57",
        "updated_at" => "2024-06-17 20:21:51",
      ),
      array(
        "code" => "01",
        "name" => "GRANJA BRETANHAS",
        "property" => 1,
        "owner" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-14 04:48:41",
        "updated_at" => "2024-06-17 20:21:45",
      ),
    );

    Farm::insert($farms);
  }
}
