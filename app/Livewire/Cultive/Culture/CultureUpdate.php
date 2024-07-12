<?php

namespace App\Livewire\Cultive\Culture;

use Livewire\Component;
// Models
use App\Models\Culture;

class CultureUpdate extends Component {
  // Register
  public $id, $culture;
  // 1° Row
  public $code, $name, $situation;

  public function mount() {
    $user = auth()->user();
    $this->culture = Culture::where('id', $this->id)->where('client_id', $user->in_client)->first();

    if (!$this->culture) {
      return redirect()->route('cultive-cultures');
    }
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $this->culture->code = mb_strtoupper($this->code, 'UTF-8');
    $this->culture->name = mb_strtoupper($this->name, 'UTF-8');
    $this->culture->situation = $this->situation;
    $this->culture->creation_user = $user->id;
    $this->culture->client_id = $user->in_client;
    $this->culture->save();

    return redirect()->route('cultive-cultures');
  }
}
