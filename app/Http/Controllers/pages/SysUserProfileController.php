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
    $user = auth()->user();

    $data['users'] = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('user_profiles.client_id', $user->in_client)
      ->select('users.id', 'users.name')
      ->groupBy('users.id', 'users.name')
      ->get();

    $data['profiles'] = Profile::where('client_id', $user->in_client)->get();

    return view('content.pages.sys.security.user-profile.create', $data);
  }

  public function userProfileCreateAction(Request $request) {
    $user = auth()->user();
    $data = $request->only(['user', 'profile', 'situation']);

    $verifyUniqueUserProfile = UserProfile::where('user_id', $data['user'])->where('profile_id', $data['profile'])->first();
    if ($verifyUniqueUserProfile) {
      return redirect()->route('sys-sec-u-ps');
    }

    $userProfile = new UserProfile();
    $userProfile->user_id = $data['user'];
    $userProfile->profile_id = $data['profile'];
    $userProfile->client_id = $user->in_client; // Salva de acordo com o usuário logado.
    $userProfile->situation = $data['situation'];
    $userProfile->save();

    return redirect()->route('sys-sec-u-ps');
  }

  public function userProfileUpdate(int $id) {
    $user = auth()->user();
    $data['userProfile'] = UserProfile::find($id);

    $data['users'] = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('user_profiles.client_id', $user->in_client)
      ->select('users.id', 'users.name')
      ->groupBy('users.id', 'users.name')
      ->get();

    $data['profiles'] = Profile::where('client_id', $user->in_client)->get();

    return view('content.pages.sys.security.user-profile.update', $data);
  }

  public function userProfileUpdateAction(int $id, Request $request) {
    $update = $request->only(['user', 'profile', 'situation']);

    $verifyUniqueUserProfile = UserProfile::where('user_id', $update['user'])->where('profile_id', $update['profile'])->first();
    if ($verifyUniqueUserProfile) {
      return redirect()->route('sys-sec-u-ps');
    }

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
