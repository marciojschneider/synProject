<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FieldsSeeder extends Seeder {
  public function run(): void {
    $fields = array(
      array(
        "code" => "1037",
        "name" => "ALFEU - GB I",
        "farm_id" => 1,
        "total_area" => 36.40,
        "productive_area" => 36.40,
        "property_registration" => "",
        "local_group" => "I",
        "locality_id" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-14 01:12:12",
        "updated_at" => "2024-06-17 20:20:41",
      ),
      array(
        "code" => "1038",
        "name" => "ALFEU - GB I",
        "farm_id" => 12,
        "total_area" => 3007.00,
        "productive_area" => 3007.00,
        "property_registration" => "",
        "local_group" => "I",
        "locality_id" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-18 00:24:10",
        "updated_at" => "2024-06-18 00:24:10",
      ),
      array(
        "code" => "1039",
        "name" => "ALFEU - GB I",
        "farm_id" => 12,
        "total_area" => 3840.00,
        "productive_area" => 3840.00,
        "property_registration" => "",
        "local_group" => "I",
        "locality_id" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-18 00:24:50",
        "updated_at" => "2024-06-18 00:24:50",
      ),
      array(
        "code" => "1040",
        "name" => "ALFEU",
        "farm_id" => 12,
        "total_area" => 809.00,
        "productive_area" => 809.00,
        "property_registration" => "",
        "local_group" => "I",
        "locality_id" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-18 00:25:26",
        "updated_at" => "2024-06-18 00:25:26",
      ),
    );

    Field::insert($fields);
  }
}
