<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Models
use App\Models\Client;

class ClientsSeeder extends Seeder {

  public function run(): void {
    $clients = [
      [
        'id' => 1,
        'code' => 'KET',
        'name' => 'KETTLOW',
        'url' => null,
        'situation' => 1,
        'creation_user' => 1,
        'created_at' => '2024-05-27 16:27:17',
        'updated_at' => '2024-06-17 18:31:00',
      ],
      [
        'id' => 2,
        'code' => 'RIT',
        'name' => 'RITTER',
        'url' => null,
        'situation' => 1,
        'creation_user' => 1,
        'created_at' => '2024-09-02 15:22:51',
        'updated_at' => '2024-09-02 15:22:51',
      ],
    ];

    Client::insert($clients);
  }
}
