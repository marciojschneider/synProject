<?php

namespace Database\Seeders;

use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfilesSeeder extends Seeder {
  public function run(): void {
    $user_profiles = array(
      array(
        "user_id" => 1,
        "profile_id" => 1,
        "client_id" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-12 06:02:50",
        "updated_at" => "2024-06-12 06:02:50",
      ),
      array(
        "user_id" => 1,
        "profile_id" => 2,
        "client_id" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-12 06:02:54",
        "updated_at" => "2024-06-12 06:02:54",
      ),
      array(
        "user_id" => 2,
        "profile_id" => 1,
        "client_id" => 1,
        "situation" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-12 06:02:59",
        "updated_at" => "2024-06-12 06:02:59",
      ),
      array(
        "user_id" => 2,
        "profile_id" => 2,
        "client_id" => 1,
        "situation" => 0,
        "creation_user" => 1,
        "created_at" => "2024-06-12 06:03:06",
        "updated_at" => "2024-06-12 18:31:44",
      ),
      array(
        "user_id" => 1,
        "profile_id" => 3,
        "client_id" => 2,
        "situation" => 1,
        "creation_user" => 1,
        "created_at" => "2024-06-12 06:02:50",
        "updated_at" => "2024-06-12 06:02:50",
      ),
    );

    UserProfile::insert($user_profiles);
  }
}
