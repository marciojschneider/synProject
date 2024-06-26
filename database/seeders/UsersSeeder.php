<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {
  public function run(): void {
    $users = array(
      array(
        "name" => "TESTE 01",
        "email" => "user.test@email.com",
        "password" => '$2y$12$YjMG55nqagRQh4IR.Q93vuaD/dHt4LZHsAoe3cXB7mzYpnklLK1mG',
        "remember_token" => NULL,
        "in_client" => 1,
        "in_profile" => 1,
        "in_time" => "2024-06-26 01:45:06",
        "situation" => 1,
        "creation_user" => NULL,
        "created_at" => "2024-06-12 06:02:28",
        "updated_at" => "2024-06-26 01:45:06",
        "deleted_at" => NULL,
      ),
      array(
        "name" => "TESTE 02",
        "email" => "user.test2@email.com",
        "password" => '$2y$12$YjMG55nqagRQh4IR.Q93vuaD/dHt4LZHsAoe3cXB7mzYpnklLK1mG',
        "remember_token" => NULL,
        "in_client" => 1,
        "in_profile" => 1,
        "in_time" => "2024-06-20 20:27:12",
        "situation" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-12 06:02:43",
        "updated_at" => "2024-06-20 20:27:12",
        "deleted_at" => NULL,
      ),
    );

    User::insert($users);
  }
}
