<?php

namespace App\Livewire\Sys\User;

use Livewire\Component;
// Importações adicionais
use Illuminate\Support\Facades\Hash;
// Models
use App\Models\User;
use App\Models\Profile;
use App\Models\UserProfile;

class UserCreate extends Component {
  // 1° Row
  public $name, $email, $password, $situation = 1;

  protected $rules = [
    'name' => 'required',
    'email' => 'required|email|unique:users,email',
    'password' => 'required|min:6|max:25'
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $user_create = new User();

    $user_create->name = mb_strtoupper($this->name, 'UTF-8');
    $user_create->email = $this->email;
    $user_create->password = Hash::make($this->password);
    $user_create->situation = $this->situation;
    $user_create->creation_user = $user->id;
    $user_create->save();

    $profileId = Profile::where('client_id', $user->in_client)->where('name', 'USUÁRIO')->select('id')->get();

    $user_profile = new UserProfile();
    $user_profile->user_id = $user_create->id;
    $user_profile->profile_id = $profileId[0]->id;
    $user_profile->creation_user = $user->id;
    $user_profile->client_id = $user->in_client;
    $user_profile->save();

    return redirect()->route('sys-users');
  }
}
