<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Models
use App\Models\UserProfile;

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
    );

    UserProfile::insert($user_profiles);
  }
}
