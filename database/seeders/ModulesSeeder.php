<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder {
  public function run(): void {
    $modules = array(
      array(
        "name" => "Geral",
        "slug" => "",
        "created_at" => "2024-05-23 17:28:38",
        "updated_at" => "2024-05-23 17:28:38",
        "description" => "Módulo genérico p/ testes",
      ),
      array(
        "name" => "Teste",
        "slug" => "",
        "created_at" => "2024-05-29 18:11:19",
        "updated_at" => "2024-05-29 18:11:19",
        "description" => "a",
      ),
    );

    Module::insert($modules);
  }
}
