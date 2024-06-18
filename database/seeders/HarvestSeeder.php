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
        "name" => "2016 A 2017",
        "situation" => 0,
        "initial_dt" => "2016-07-01 00:00:00",
        "ending_dt" => "2017-06-30 00:00:00",
        "price_table" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-03 17:21:29",
        "updated_at" => "2024-06-17 20:23:38",
      ),
      array(
        "code" => "1718",
        "name" => "2017 A 2018",
        "situation" => 0,
        "initial_dt" => "2017-07-01 00:00:00",
        "ending_dt" => "2018-06-30 00:00:00",
        "price_table" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-03 17:21:48",
        "updated_at" => "2024-06-17 20:23:42",
      ),
      array(
        "code" => "1819",
        "name" => "2018 A 2019",
        "situation" => 0,
        "initial_dt" => "2018-07-01 00:00:00",
        "ending_dt" => "2019-06-30 00:00:00",
        "price_table" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-03 17:29:00",
        "updated_at" => "2024-06-17 20:23:45",
      ),
      array(
        "code" => "1920",
        "name" => "2019 A 2020",
        "situation" => 0,
        "initial_dt" => "2019-07-01 00:00:00",
        "ending_dt" => "2020-06-30 00:00:00",
        "price_table" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-03 17:29:16",
        "updated_at" => "2024-06-17 20:23:48",
      ),
      array(
        "code" => "2021",
        "name" => "2020 A 2021",
        "situation" => 0,
        "initial_dt" => "2020-07-01 00:00:00",
        "ending_dt" => "2021-06-30 00:00:00",
        "price_table" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-03 17:29:34",
        "updated_at" => "2024-06-17 20:23:51",
      ),
      array(
        "code" => "2122",
        "name" => "2021 A 2022",
        "situation" => 0,
        "initial_dt" => "2021-07-01 00:00:00",
        "ending_dt" => "2022-06-30 00:00:00",
        "price_table" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-03 17:29:51",
        "updated_at" => "2024-06-17 20:23:54",
      ),
      array(
        "code" => "2223",
        "name" => "2022 A 2023",
        "situation" => 0,
        "initial_dt" => "2022-07-01 00:00:00",
        "ending_dt" => "2023-06-30 00:00:00",
        "price_table" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-03 17:30:08",
        "updated_at" => "2024-06-17 20:23:57",
      ),
      array(
        "code" => "2324",
        "name" => "2023 A 2024",
        "situation" => 1,
        "initial_dt" => "2023-07-01 00:00:00",
        "ending_dt" => "2024-06-30 00:00:00",
        "price_table" => 0,
        "creation_user" => 1,
        "client_id" => 1,
        "created_at" => "2024-06-03 17:30:39",
        "updated_at" => "2024-06-17 20:23:34",
      ),
    );

    Harvest::insert($harvests);
  }
}
