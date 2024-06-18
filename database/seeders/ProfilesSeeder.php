<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder {

  public function run(): void {
    $profiles = array(
      array(
        "name" => "USUÁRIO",
        "client_id" => 1,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-06-17 18:31:21",
        "situation" => 1,
      ),
      array(
        "name" => "ADMINISTRADOR",
        "client_id" => 1,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-05-27 16:27:17",
        "situation" => 1,
      ),
      array(
        "name" => "USUÁRIO",
        "client_id" => 2,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-05-27 16:27:17",
        "situation" => 1,
      ),
      array(
        "name" => "ADMINISTRADOR",
        "client_id" => 2,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-05-27 16:27:17",
        "situation" => 1,
      ),
    );


    Profile::insert($profiles);
  }
}
