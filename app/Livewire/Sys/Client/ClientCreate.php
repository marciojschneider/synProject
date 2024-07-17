<?php

namespace App\Livewire\Sys\Client;

use Livewire\Component;
// Models
use App\Models\Client;

class ClientCreate extends Component {
  // 1° Row
  public $code, $name, $url, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $client = new Client();

    $client->code = mb_strtoupper($this->code, 'UTF-8');
    $client->name = mb_strtoupper($this->name, 'UTF-8');
    $client->url = $this->url;
    $client->situation = $this->situation;
    $client->creation_user = $user->id;
    $client->client_id = $user->in_client;
    $client->save();

    return redirect()->route('sys-clients');
  }
}
