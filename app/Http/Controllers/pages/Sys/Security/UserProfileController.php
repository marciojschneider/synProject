<?php

namespace App\Http\Controllers\pages\Sys\Security;

use App\Http\Controllers\Controller;

class UserProfileController extends Controller {
  public function userProfiles() {
    return view('content.pages.sys.security.user-profile.list');
  }

  public function userProfileCreate() {
    return view('content.pages.sys.security.user-profile.create');
  }

  public function userProfileUpdate(int $id) {
    return view('content.pages.sys.security.user-profile.update', compact('id'));
  }
}
