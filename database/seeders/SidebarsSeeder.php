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
        "url" => "/",
        "client_id" => "0",
        "permission" => "3",
        "order" => 1,
        "created_at" => "2024-05-22 18:34:35",
        "updated_at" => "2024-05-22 18:34:35",
      ),
      array(
        "name" => "Sistema",
        "icon" => "bx bx-cog me-2",
        "slug" => "sys",
        "affiliate_id" => 0,
        "url" => "",
        "client_id" => "0",
        "permission" => "1",
        "order" => 2,
        "created_at" => "2024-05-22 18:53:47",
        "updated_at" => "2024-05-22 18:53:47",
      ),
      array(
        "name" => "Usuários",
        "icon" => NULL,
        "slug" => "user",
        "affiliate_id" => 2,
        "url" => "/users",
        "client_id" => "0",
        "permission" => "1",
        "order" => 1,
        "created_at" => "2024-05-22 18:56:26",
        "updated_at" => "2024-05-22 18:56:26",
      ),
      array(
        "name" => "Clientes",
        "icon" => NULL,
        "slug" => "client",
        "affiliate_id" => 2,
        "url" => "/clients",
        "client_id" => "0",
        "permission" => "1",
        "order" => 2,
        "created_at" => "2024-05-22 19:08:16",
        "updated_at" => "2024-05-22 19:08:16",
      ),
      array(
        "name" => "Perfis",
        "icon" => NULL,
        "slug" => "profile",
        "affiliate_id" => 2,
        "url" => "/profiles",
        "client_id" => "0",
        "permission" => "1",
        "order" => 3,
        "created_at" => "2024-05-22 19:19:02",
        "updated_at" => "2024-05-22 19:19:02",
      ),
      array(
        "name" => "Módulos",
        "icon" => NULL,
        "slug" => "module",
        "affiliate_id" => 2,
        "url" => "/modules",
        "client_id" => "0",
        "permission" => "1",
        "order" => 4,
        "created_at" => "2024-05-22 19:24:20",
        "updated_at" => "2024-05-22 19:24:22",
      ),
      array(
        "name" => "Suporte",
        "icon" => "menu-icon tf-icons bx bx-support",
        "slug" => "sup",
        "affiliate_id" => 0,
        "url" => "",
        "client_id" => "0",
        "permission" => "2",
        "order" => 3,
        "created_at" => "2024-05-23 19:55:42",
        "updated_at" => "2024-05-23 19:55:42",
      ),
      array(
        "name" => "Roadmap",
        "icon" => NULL,
        "slug" => "roadmap",
        "affiliate_id" => 7,
        "url" => "/roadmap",
        "client_id" => "0",
        "permission" => "1",
        "order" => 2,
        "created_at" => "2024-05-23 19:56:11",
        "updated_at" => "2024-05-23 19:56:11",
      ),
      array(
        "name" => "Tarefas",
        "icon" => NULL,
        "slug" => "task",
        "affiliate_id" => 7,
        "url" => "/task",
        "client_id" => "0",
        "permission" => "3",
        "order" => 1,
        "created_at" => "2024-05-27 16:27:17",
        "updated_at" => "2024-05-27 16:27:17",
      ),
    );

    Sidebar::insert($sidebars);
  }
}
