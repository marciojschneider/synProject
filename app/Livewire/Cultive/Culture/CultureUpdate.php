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

    $this->code = $this->culture->code;
    $this->name = $this->culture->name;
    $this->situation = $this->culture->situation;
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->culture->code = mb_strtoupper($this->code, 'UTF-8');
    $this->culture->name = mb_strtoupper($this->name, 'UTF-8');
    $this->culture->situation = $this->situation;
    $this->culture->save();

    return redirect()->route('cultive-cultures');
  }
}
