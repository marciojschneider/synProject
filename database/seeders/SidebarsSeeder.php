<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Sidebar;

class SidebarsSeeder extends Seeder {
  public function run(): void {
    $sidebars = array(
      array(
        "name" => "Inicio",
        "icon" => "menu-icon tf-icons bx bx-home-circle",
        "slug" => "homepage",
        "affiliate_id" => 0,
        "client_id" => "0",
        "permission" => "3",
        "order" => 1,
        "created_at" => "2024-05-22 18:34:35",
        "updated_at" => "2024-05-22 18:34:35",
        "url" => "/",
      ),
      array(
        "name" => "Sistema",
        "icon" => "bx bx-cog me-2",
        "slug" => "sys",
        "affiliate_id" => 0,
        "client_id" => "0",
        "permission" => "1",
        "order" => 2,
        "created_at" => "2024-05-22 18:53:47",
        "updated_at" => "2024-05-22 18:53:47",
        "url" => "",
      ),
      array(
        "name" => "Usuários",
        "icon" => NULL,
        "slug" => "user",
        "affiliate_id" => 2,
        "client_id" => "0",
        "permission" => "1",
        "order" => 1,
        "created_at" => "2024-05-22 18:56:26",
        "updated_at" => "2024-05-22 18:56:26",
        "url" => "/users",
      ),
      array(
        "name" => "Clientes",
        "icon" => NULL,
        "slug" => "client",
        "affiliate_id" => 2,
        "client_id" => "0",
        "permission" => "1",
        "order" => 2,
        "created_at" => "2024-05-22 19:08:16",
        "updated_at" => "2024-05-22 19:08:16",
        "url" => "/clients",
      ),
      array(
        "name" => "Perfis",
        "icon" => NULL,
        "slug" => "profile",
        "affiliate_id" => 2,
        "client_id" => "0",
        "permission" => "1",
        "order" => 3,
        "created_at" => "2024-05-22 19:19:02",
        "updated_at" => "2024-05-22 19:19:02",
        "url" => "/profiles",
      ),
      array(
        "name" => "Modulos",
        "icon" => NULL,
        "slug" => "module",
        "affiliate_id" => 2,
        "client_id" => "0",
        "permission" => "1",
        "order" => 4,
        "created_at" => "2024-05-22 19:24:20",
        "updated_at" => "2024-05-22 19:24:22",
        "url" => "/modules",
      ),
    );

    Sidebar::insert($sidebars);
  }
}
