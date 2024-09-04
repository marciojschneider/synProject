<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Models
use App\Models\Profile;

class ProfilesSeeder extends Seeder {

  public function run(): void {
    $profiles = [
      [
        'id' => 1,
        'name' => 'USUÁRIO',
        'client_id' => 1,
        'creation_user' => 1,
        'created_at' => '2024-05-27 16:27:17',
        'updated_at' => '2024-06-17 18:31:21',
        'situation' => 1,
      ],
      [
        'id' => 2,
        'name' => 'ADMINISTRADOR',
        'client_id' => 1,
        'creation_user' => 1,
        'created_at' => '2024-05-27 16:27:17',
        'updated_at' => '2024-06-20 17:45:56',
        'situation' => 1,
      ],
      [
        'id' => 3,
        'name' => 'USUÁRIO',
        'client_id' => 2,
        'creation_user' => 1,
        'created_at' => '2024-09-02 15:22:51',
        'updated_at' => '2024-09-02 15:22:51',
        'situation' => 1,
      ],
      [
        'id' => 4,
        'name' => 'ADMINISTRADOR',
        'client_id' => 2,
        'creation_user' => 1,
        'created_at' => '2024-09-02 15:22:51',
        'updated_at' => '2024-09-02 15:22:51',
        'situation' => 1,
      ],
      [
        'id' => 5,
        'name' => 'SEPARADOR',
        'client_id' => 2,
        'creation_user' => 1,
        'created_at' => '2024-09-03 13:55:53',
        'updated_at' => '2024-09-03 13:55:53',
        'situation' => 1,
      ],
    ];

    Profile::insert($profiles);
  }
}
