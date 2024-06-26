<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder {
  public function run(): void {
    $groups = array(
      array(
        "code" => "01",
        "name" => "CONVENCIONAL",
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-17 17:31:02",
        "updated_at" => "2024-06-17 18:27:53",
      ),
      array(
        "code" => "02",
        "name" => "CL",
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-17 17:31:18",
        "updated_at" => "2024-06-17 17:32:01",
      ),
      array(
        "code" => "03",
        "name" => "MIRTILO",
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-17 17:32:26",
        "updated_at" => "2024-06-17 18:27:57",
      ),
      array(
        "code" => "04",
        "name" => "PASTAGEM",
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-17 17:32:34",
        "updated_at" => "2024-06-17 18:28:00",
      ),
      array(
        "code" => "999",
        "name" => "A DEFINIR",
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-17 17:32:41",
        "updated_at" => "2024-06-17 18:28:03",
      ),
    );

    Group::insert($groups);
  }
}
