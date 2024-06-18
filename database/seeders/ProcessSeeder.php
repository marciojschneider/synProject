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
        "name" => "PREPARO DE SOLO",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:13",
        "updated_at" => "2024-06-17 18:28:16",
      ),
      array(
        "code" => "1.2",
        "name" => "PLANTIO",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:20",
        "updated_at" => "2024-06-17 18:28:19",
      ),
      array(
        "code" => "1.3",
        "name" => "TRATAMENTO CULTURAL",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:30",
        "updated_at" => "2024-06-17 18:28:25",
      ),
      array(
        "code" => "1.4",
        "name" => "COLHEITA",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:38",
        "updated_at" => "2024-06-17 18:28:28",
      ),
      array(
        "code" => "1.5",
        "name" => "PREPARO DE VERÃO",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:15:49",
        "updated_at" => "2024-06-17 18:28:33",
      ),
      array(
        "code" => "1.6",
        "name" => "REPLANTIO",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:00",
        "updated_at" => "2024-06-17 18:28:38",
      ),
      array(
        "code" => "2.1",
        "name" => "TRANSPORTE",
        "type" => 2,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:19",
        "updated_at" => "2024-06-17 18:28:47",
      ),
      array(
        "code" => "2.2",
        "name" => "OUTROS DIVERSOS",
        "type" => 2,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:31",
        "updated_at" => "2024-06-17 18:28:43",
      ),
      array(
        "code" => "1.7",
        "name" => "SISTEMATIZAÇÃO",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:47",
        "updated_at" => "2024-06-17 18:28:52",
      ),
      array(
        "code" => "1.8",
        "name" => "LEVANTAMENTO",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:16:56",
        "updated_at" => "2024-06-17 18:28:56",
      ),
      array(
        "code" => "1.9",
        "name" => "LIMPEZA",
        "type" => 1,
        "situation" => 1,
        "created_at" => "2024-06-03 22:17:05",
        "updated_at" => "2024-06-17 18:29:28",
      ),
    );

    Process::insert($processes);
  }
}
