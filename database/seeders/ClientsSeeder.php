<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
      array(
        "code" => "KET",
        "name" => "KETTLOW",
        "url" => NULL,
        "situation" => 0,
        "creation_user" => 1,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-06-20 17:45:01",
      ),
    );

    Client::insert($clients);
  }
}
