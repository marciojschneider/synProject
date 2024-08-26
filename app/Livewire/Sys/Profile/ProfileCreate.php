<?php

namespace App\Livewire\Sys\Profile;

use Livewire\Component;

// Models
use App\Models\Profile;
use App\Models\Client;
use App\Models\ProfilePermission;

class ProfileCreate extends Component {
  // Selects
  public $clients;
  // 1° Row
  public $name, $client, $situation = 1;

  public function mount() {
    $user = auth()->user();
    $this->clients = Client::where('id', $user->in_client)->where('situation', 1)->get();
  }

  protected $rules = [
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $profile = new Profile();

    $profile->name = mb_strtoupper($this->name, 'UTF-8');
    $profile->situation = $this->situation;
    $profile->creation_user = $user->id;
    $profile->client_id = $user->in_client;
    $profile->save();

    $profile_permission = new ProfilePermission();
    $profile_permission->profile_id = $profile->id;
    $profile_permission->sidebar_id = 1;
    $profile_permission->client_id = $user->in_client;
    $profile_permission->affiliate_id = 1;
    $profile_permission->view = 1;
    $profile_permission->create = 0;
    $profile_permission->update = 0;
    $profile_permission->delete = 0;
    $profile_permission->situation = 1;
    $profile_permission->creation_user = $user->id;
    $profile_permission->client_id = $user->in_client;
    $profile_permission->save();

    return redirect()->route('sys-profiles');
  }
}
