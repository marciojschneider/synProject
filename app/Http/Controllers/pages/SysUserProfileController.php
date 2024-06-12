<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;

// Models
use App\Models\Profile;
use App\Models\User;

class SysUserProfileController extends Controller {
  public function userProfiles() {
    return view('content.pages.sys.security.user-profile.list');
  }

  public function userProfileCreate() {
    $data['users'] = User::all();
    $data['profiles'] = Profile::all();

    return view('content.pages.sys.security.user-profile.create', $data);
  }

  public function userProfileCreateAction(Request $request) {
    $data = $request->only(['user', 'profile', 'situation']);

    $userProfile = new UserProfile();
    $userProfile->user_id = $data['user'];
    $userProfile->profile_id = $data['profile'];
    $userProfile->situation = $data['situation'];
    $userProfile->save();

    return redirect()->route('sys-sec-user-profiles');
  }

  public function userProfileUpdate(int $id) {
    return view('content.pages.sys.security.user-profile.update');
  }

  public function userProfileUpdateAction(int $id, Request $request) {
    dd($request);
  }

  public function userProfileDelete(int $id) {
    dd($id);
  }
}
