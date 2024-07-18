<?php

namespace App\Livewire\Sys\Security\UserProfile;

use Livewire\Component;
// Models
use App\Models\UserProfile;
use App\Models\Profile;
use App\Models\User;

class UserProfileCreate extends Component {
  // Selects
  public $users, $profiles;
  // 1° Row
  public $user, $profile, $situation = 1;

  public function mount() {
    $user = auth()->user();

    $this->users = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('user_profiles.client_id', $user->in_client)
      ->where('users.situation', 1)
      ->select('users.id', 'users.name')
      ->groupBy('users.id', 'users.name')
      ->get();

    $this->profiles = Profile::where('client_id', $user->in_client)->where('situation', 1)->get();
  }

  protected $rules = [
    'user' => 'required',
    'profile' => 'required'
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $verifyUniqueUserProfile = UserProfile::where('user_id', $this->user)->where('profile_id', $this->profile)->first();
    if ($verifyUniqueUserProfile) {
      return redirect()->route('sys-sec-u-ps');
    }

    $user_profile = new UserProfile();

    $user_profile->user_id = $this->user;
    $user_profile->profile_id = $this->profile;
    $user_profile->situation = $this->situation;
    $user_profile->creation_user = $user->id;
    $user_profile->client_id = $user->in_client;
    $user_profile->save();

    return redirect()->route('sys-sec-u-ps');
  }
}
