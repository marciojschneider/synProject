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
        "name" => "Synérgya",
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-05-27 16:27:17",
      ),
      array(
        "code" => "KET",
        "name" => "Kettlow",
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-05-27 16:27:17",
      ),
    );

    Client::insert($clients);
  }
}
