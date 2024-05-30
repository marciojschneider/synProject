<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder {

  public function run(): void {
    $profiles = array(
      array(
        "name" => "Usuário",
        "client_id" => 1,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-05-27 16:27:17",
      ),
      array(
        "name" => "Administrador",
        "client_id" => 1,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-05-27 16:27:17",
      ),
    );

    Profile::insert($profiles);
  }
}
