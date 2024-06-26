<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationsSeeder extends Seeder {
  public function run(): void {
    $organizations = array(
      array(
        "code" => "10",
        "name" => "GRANJA BRETANHAS",
        "external_code" => "10",
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-04 18:21:31",
        "updated_at" => "2024-06-17 20:22:26",
      ),
      array(
        "code" => "60",
        "name" => "ARROIO GRANDE",
        "external_code" => "60",
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-04 18:22:15",
        "updated_at" => "2024-06-20 21:26:12",
      ),
      array(
        "code" => "20",
        "name" => "CONDOMINIO",
        "external_code" => "20",
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-04 18:23:26",
        "updated_at" => "2024-06-17 20:22:36",
      ),
    );

    Organization::insert($organizations);
  }
}
