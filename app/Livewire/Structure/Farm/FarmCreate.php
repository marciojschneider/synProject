<?php

namespace App\Livewire\Structure\Farm;

use Livewire\Component;
// Models
use App\Models\Farm;

class FarmCreate extends Component {
  // 1° Row
  public $code, $name, $property = 1, $owner = 1, $situation = 1;

  protected $rules = [
    'code' => 'required',
    'name' => 'required',
  ];

  public function submit() {
    $user = auth()->user();
    $this->validate();

    $farm = new Farm();

    $farm->code = mb_strtoupper($this->code, 'UTF-8');
    $farm->name = mb_strtoupper($this->name, 'UTF-8');
    $farm->property = $this->property;
    $farm->owner = $this->owner;
    $farm->situation = $this->situation;
    $farm->creation_user = $user->id;
    $farm->client_id = $user->in_client;
    $farm->save();

    return redirect()->route('structure-farms');
  }
}
