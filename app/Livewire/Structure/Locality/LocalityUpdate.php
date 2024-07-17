<?php

namespace App\Livewire\Structure\Locality;

use Livewire\Component;
// Models
use App\Models\Locality;

class LocalityUpdate extends Component {
  // Register
  public $id, $locality;
  // 1° Row
  public $code, $name, $situation = 1;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->locality = Locality::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->locality) {
      return redirect()->route('structure-localities');
    }
    // 1° Row
    $this->code = $this->locality->code;
    $this->name = $this->locality->name;
    $this->situation = $this->locality->situation;
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->locality->code = mb_strtoupper($this->code, 'UTF-8');
    $this->locality->name = mb_strtoupper($this->name, 'UTF-8');
    $this->locality->situation = $this->situation;
    $this->locality->save();

    return redirect()->route('structure-localities');
  }
}
