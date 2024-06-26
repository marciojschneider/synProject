<?php

namespace Database\Seeders;

use App\Models\ClosureModule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClosureModulesSeeder extends Seeder {
  /**
   * Run the database seeds.
   */
  public function run(): void {
    $closure_modules = array(
      array(
        "sidebar_id" => 16,
        "client_id" => 1,
        "dt_closure" => "2024-06-01 00:00:00",
        "situation" => 1,
        "creation_user" => NULL,
        "created_at" => "2024-06-20 17:57:50",
        "updated_at" => "2024-06-20 17:57:50",
      ),
      array(
        "sidebar_id" => 27,
        "client_id" => 1,
        "dt_closure" => "2024-06-01 00:00:00",
        "situation" => 1,
        "creation_user" => NULL,
        "created_at" => "2024-06-20 21:34:14",
        "updated_at" => "2024-06-20 21:34:14",
      ),
    );

    ClosureModule::insert($closure_modules);
  }
}
