<?php

namespace App\Http\Controllers\pages\Sys\Security;

use App\Http\Controllers\Controller;
// Models
use App\Models\UserProfile;

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

  public function userProfileDelete(int $id) {
    $user = auth()->user();
    UserProfile::where('id', $id)->where('client_id', $user->in_client)->delete();

    return redirect()->route('sys-sec-u-ps');
  }
}
