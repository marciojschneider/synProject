<?php

namespace App\Livewire\Sys\Security\UserProfile;

use Livewire\Component;
// Models
use App\Models\UserProfile;
use App\Models\Profile;
use App\Models\User;

class UserProfileUpdate extends Component {
  // Register
  public $id, $user_profile;

  // 1° Row
  public $users = [], $user, $profiles = [], $profile, $situation;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->user_profile = UserProfile::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->user_profile) {
      return redirect()->route('sys-sec-u-ps');
    }
    // Selects
    $this->users = User::join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
      ->where('user_profiles.client_id', $user->in_client)
      ->where('users.situation', 1)
      ->select('users.id', 'users.name')
      ->groupBy('users.id', 'users.name')
      ->get();

    $this->profiles = Profile::where('client_id', $user->in_client)->where('situation', 1)->get();
    // 1° Row
    $this->user = $this->user_profile->user_id;
    $this->profile = $this->user_profile->profile_id;
    $this->situation = $this->user_profile->situation;
  }

  protected $rules = [
    'user' => 'required',
    'profile' => 'required'
  ];

  public function submit() {
    $this->validate();

    $verifyUniqueUserProfile = UserProfile::where('user_id', $this->user)->where('profile_id', $this->profile)->where('id', '!=', $this->user_profile->id)->first();
    if ($verifyUniqueUserProfile) {
      return redirect()->route('sys-sec-u-ps');
    }

    $this->user_profile->user_id = $this->user;
    $this->user_profile->profile_id = $this->profile;
    $this->user_profile->situation = $this->situation;
    $this->user_profile->save();

    return redirect()->route('sys-sec-u-ps');
  }
}
