<?php

namespace App\Livewire\Cultive\Culture;

use Livewire\Component;
// Models
use App\Models\Culture;

class CultureCreate extends Component {
  // 1° Row
  public $code, $name, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $culture = new Culture();
    $culture->code = mb_strtoupper($this->code, 'UTF-8');
    $culture->name = mb_strtoupper($this->name, 'UTF-8');
    $culture->situation = $this->situation;
    $culture->creation_user = $user->id;
    $culture->client_id = $user->in_client;
    $culture->save();

    return redirect()->route('cultive-cultures');
  }
}
