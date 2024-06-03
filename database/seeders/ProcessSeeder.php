<?php

namespace Database\Seeders;

use App\Models\Process;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder {

  public function run(): void {
    $processes = array(
      array(
        "code" => "1.1",
        "name" => "Preparo de solo",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:13",
        "updated_at" => "2024-06-03 22:17:14",
      ),
      array(
        "code" => "1.2",
        "name" => "Plantio",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:20",
        "updated_at" => "2024-06-03 22:15:20",
      ),
      array(
        "code" => "1.3",
        "name" => "Tratamento Cultural",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:30",
        "updated_at" => "2024-06-03 22:15:30",
      ),
      array(
        "code" => "1.4",
        "name" => "Colheita",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:38",
        "updated_at" => "2024-06-03 22:15:38",
      ),
      array(
        "code" => "1.5",
        "name" => "Preparo de verão",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:49",
        "updated_at" => "2024-06-03 22:15:49",
      ),
      array(
        "code" => "1.6",
        "name" => "Replantio",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:00",
        "updated_at" => "2024-06-03 22:16:00",
      ),
      array(
        "code" => "2.1",
        "name" => "Transporte",
        "type" => 2,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:19",
        "updated_at" => "2024-06-03 22:16:19",
      ),
      array(
        "code" => "2.2",
        "name" => "Outros diversos",
        "type" => 2,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:31",
        "updated_at" => "2024-06-03 22:16:31",
      ),
      array(
        "code" => "1.7",
        "name" => "Sistematização",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:47",
        "updated_at" => "2024-06-03 22:16:47",
      ),
      array(
        "code" => "1.8",
        "name" => "Levantamento",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:56",
        "updated_at" => "2024-06-03 22:16:56",
      ),
      array(
        "code" => "1.9",
        "name" => "Limpeza",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:17:05",
        "updated_at" => "2024-06-03 22:17:05",
      ),
    );

    Process::insert($processes);
  }
}
