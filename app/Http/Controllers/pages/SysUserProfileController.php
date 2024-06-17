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
    $user = auth()->user();
    $data = $request->only(['user', 'profile', 'situation']);

    $userProfile = new UserProfile();
    $userProfile->user_id = $data['user'];
    $userProfile->profile_id = $data['profile'];
    $userProfile->client_id = $user->in_client; // Salva de acordo com o usuário logado.
    $userProfile->situation = $data['situation'];
    $userProfile->save();

    return redirect()->route('sys-sec-u-ps');
  }

  public function userProfileUpdate(int $id) {
    $data['users'] = User::all();
    $data['profiles'] = Profile::all();
    $data['userProfile'] = UserProfile::find($id);

    return view('content.pages.sys.security.user-profile.update', $data);
  }

  public function userProfileUpdateAction(int $id, Request $request) {
    $update = $request->only(['user', 'profile', 'situation']);

    $userProfileUpdate = UserProfile::find($id);
    $userProfileUpdate->user_id = $update['user'];
    $userProfileUpdate->profile_id = $update['profile'];
    $userProfileUpdate->situation = $update['situation'];
    $userProfileUpdate->save();

    return redirect()->route('sys-sec-u-ps');
  }

  public function userProfileDelete(int $id) {
    UserProfile::where('id', $id)->delete();

    return redirect()->route('sys-sec-u-ps');
  }
}
