<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Models
use App\Models\Client;

class ClientsSeeder extends Seeder {

  public function run(): void {
    $clients = array(
      array(
        "code" => "SYN",
        "name" => "SYNÉRGYA",
        "url" => NULL,
        "situation" => 1,
        "creation_user" => 1,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-06-17 18:31:00",
      ),
    );

    Client::insert($clients);
  }
}
