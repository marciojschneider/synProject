<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Harvest;

class HarvestSeeder extends Seeder {
  public function run(): void {
    $harvests = array(
      array(
        "code" => "1617",
        "name" => "2016 a 2017",
        "situation" => 0,
        "initial_dt" => "2016-07-01 00:00:00",
        "ending_dt" => "2017-06-30 00:00:00",
        "price_table" => 0,
        "created_at" => "2024-06-03 17:21:29",
        "updated_at" => "2024-06-03 17:21:29",
      ),
      array(
        "code" => "1718",
        "name" => "2017 a 2018",
        "situation" => 0,
        "initial_dt" => "2017-07-01 00:00:00",
        "ending_dt" => "2018-06-30 00:00:00",
        "price_table" => 0,
        "created_at" => "2024-06-03 17:21:48",
        "updated_at" => "2024-06-03 17:21:48",
      ),
      array(
        "code" => "1819",
        "name" => "2018 a 2019",
        "situation" => 0,
        "initial_dt" => "2018-07-01 00:00:00",
        "ending_dt" => "2019-06-30 00:00:00",
        "price_table" => 0,
        "created_at" => "2024-06-03 17:29:00",
        "updated_at" => "2024-06-03 17:29:00",
      ),
      array(
        "code" => "1920",
        "name" => "2019 a 2020",
        "situation" => 0,
        "initial_dt" => "2019-07-01 00:00:00",
        "ending_dt" => "2020-06-30 00:00:00",
        "price_table" => 0,
        "created_at" => "2024-06-03 17:29:16",
        "updated_at" => "2024-06-03 17:29:16",
      ),
      array(
        "code" => "2021",
        "name" => "2020 a 2021",
        "situation" => 0,
        "initial_dt" => "2020-07-01 00:00:00",
        "ending_dt" => "2021-06-30 00:00:00",
        "price_table" => 0,
        "created_at" => "2024-06-03 17:29:34",
        "updated_at" => "2024-06-03 17:29:34",
      ),
      array(
        "code" => "2122",
        "name" => "2021 a 2022",
        "situation" => 0,
        "initial_dt" => "2021-07-01 00:00:00",
        "ending_dt" => "2022-06-30 00:00:00",
        "price_table" => 0,
        "created_at" => "2024-06-03 17:29:51",
        "updated_at" => "2024-06-03 17:29:51",
      ),
      array(
        "code" => "2223",
        "name" => "2022 a 2023",
        "situation" => 0,
        "initial_dt" => "2022-07-01 00:00:00",
        "ending_dt" => "2023-06-30 00:00:00",
        "price_table" => 0,
        "created_at" => "2024-06-03 17:30:08",
        "updated_at" => "2024-06-03 17:30:08",
      ),
      array(
        "code" => "2324",
        "name" => "2023 a 2024",
        "situation" => 1,
        "initial_dt" => "2023-07-01 00:00:00",
        "ending_dt" => "2024-06-30 00:00:00",
        "price_table" => 0,
        "created_at" => "2024-06-03 17:30:39",
        "updated_at" => "2024-06-03 17:30:39",
      ),
    );

    Harvest::insert($harvests);
  }
}
