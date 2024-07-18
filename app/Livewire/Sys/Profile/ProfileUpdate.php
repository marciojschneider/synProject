<?php

namespace App\Livewire\Sys\Profile;

use Livewire\Component;
// Models
use App\Models\Profile;
use App\Models\Client;

class ProfileUpdate extends Component {
  // Register
  public $id, $profile;

  // 1° Row
  public $name, $clients = [], $client, $situation;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->profile = Profile::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->profile) {
      return redirect()->route('sys-profiles');
    }
    // Selects
    $this->clients = Client::where('id', $user->in_client)->where('situation', 1)->get();
    // 1° Row
    $this->name = $this->profile->name;
    $this->client = $this->profile->client_id;
    $this->situation = $this->profile->situation;
  }

  protected $rules = [
    'name' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->profile->name = mb_strtoupper($this->name, 'UTF-8');
    $this->profile->situation = $this->situation;
    $this->profile->save();

    return redirect()->route('sys-profiles');
  }
}
