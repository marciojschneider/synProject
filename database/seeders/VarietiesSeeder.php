<?php

namespace Database\Seeders;

use App\Models\Variety;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VarietiesSeeder extends Seeder {
  public function run(): void {
    $varieties = array(
      array(
        "code" => "01",
        "name" => "IRGA 424RI",
        "culture_id" => 1,
        "group_id" => 2,
        "situation" => 1,
        "client_id" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-17 17:58:34",
        "updated_at" => "2024-06-17 17:58:34",
      ),
      array(
        "code" => "02",
        "name" => "IRGA 426",
        "culture_id" => 1,
        "group_id" => 1,
        "situation" => 1,
        "client_id" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-17 18:00:53",
        "updated_at" => "2024-06-17 18:04:29",
      ),
      array(
        "code" => "03",
        "name" => "PUITA",
        "culture_id" => 1,
        "group_id" => 2,
        "situation" => 1,
        "client_id" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-17 18:09:50",
        "updated_at" => "2024-06-17 18:09:50",
      ),
      array(
        "code" => "04",
        "name" => "GURI",
        "culture_id" => 1,
        "group_id" => 2,
        "situation" => 1,
        "client_id" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-17 18:10:02",
        "updated_at" => "2024-06-17 18:10:02",
      ),
      array(
        "code" => "05",
        "name" => "HIBRIDO XP739MA",
        "culture_id" => 1,
        "group_id" => 1,
        "situation" => 1,
        "client_id" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-18 00:54:36",
        "updated_at" => "2024-06-18 00:54:36",
      ),
      array(
        "code" => "13",
        "name" => "IRGA 431",
        "culture_id" => 1,
        "group_id" => 1,
        "situation" => 1,
        "client_id" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-18 00:55:02",
        "updated_at" => "2024-06-18 00:55:02",
      ),
      array(
        "code" => "14",
        "name" => "PRIMORISO",
        "culture_id" => 1,
        "group_id" => 2,
        "situation" => 1,
        "client_id" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-18 00:55:12",
        "updated_at" => "2024-06-18 00:55:28",
      ),
      array(
        "code" => "15",
        "name" => "MEMBY PORA",
        "culture_id" => 1,
        "group_id" => 2,
        "situation" => 1,
        "client_id" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-18 00:55:42",
        "updated_at" => "2024-06-18 00:55:42",
      ),
    );

    Variety::insert($varieties);
  }
}
