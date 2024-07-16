<?php

namespace App\Livewire\Structure\Farm;

use App\Models\Farm;
use Livewire\Component;

class FarmUpdate extends Component {
  // Register
  public $id, $farm;
  // 1° Row
  public $code, $name, $property, $owner, $situation;

  public function mount() {
    $user = auth()->user();
    // Values
    $this->farm = Farm::where('id', $this->id)->where('client_id', $user->in_client)->first();
    if (!$this->farm) {
      return redirect()->route('structure-farms');
    }
    // 1° Row
    $this->code = $this->farm->code;
    $this->name = $this->farm->name;
    $this->property = $this->farm->property;
    $this->owner = $this->farm->owner;
    $this->situation = $this->farm->situation;
  }

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $this->validate();

    $this->farm->code = mb_strtoupper($this->code, 'UTF-8');
    $this->farm->name = mb_strtoupper($this->name, 'UTF-8');
    $this->farm->property = $this->property;
    $this->farm->owner = $this->owner;
    $this->farm->situation = $this->situation;
    $this->farm->save();

    return redirect()->route('structure-farms');
  }
}
