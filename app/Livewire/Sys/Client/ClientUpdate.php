<?php

namespace App\Livewire\Sys\Client;

use Livewire\Component;
// Models
use App\Models\Client;

class ClientUpdate extends Component {
  // Register
  public $id, $client;

  // 1° Row
  public $code, $name, $url, $situation;

  public function mount() {
    // Values
    $this->client = Client::find($this->id);
    if (!$this->client) {
      return redirect()->route('sys-clients');
    }
    // 1° Row
    $this->code = $this->client->code;
    $this->name = $this->client->name;
    $this->url = $this->client->url;
    $this->situation = $this->client->situation;
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->client->code = mb_strtoupper($this->code, 'UTF-8');
    $this->client->name = mb_strtoupper($this->name, 'UTF-8');
    $this->client->url = $this->url;
    $this->client->situation = $this->situation;
    $this->client->save();

    return redirect()->route('sys-clients');
  }
}
